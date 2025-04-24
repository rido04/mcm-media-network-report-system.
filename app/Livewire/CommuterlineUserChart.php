<?php
namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\DailyImpression;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommuterlineUserChart extends Component
{
    public $timeRange = 'daily'; // default filter

    public function mount()
    {
        //
    }

    public function changeTimeRange($range)
    {
        $this->timeRange = $range;
    }

    public function render()
    {
        // Count date range choosen
        switch ($this->timeRange) {
            case 'daily':
                $startDate = now()->subDays(7)->format('Y-m-d');
                $endDate = now()->format('Y-m-d');
                break;
            case 'weekly':
                $startDate = now()->subWeeks(8)->startOfWeek()->format('Y-m-d');
                $endDate = now()->endOfWeek()->format('Y-m-d');
                break;
            case 'monthly':
                $startDate = now()->subMonths(11)->startOfMonth()->format('Y-m-d'); // 12 months data
                $endDate = now()->endOfMonth()->format('Y-m-d');
                break;
            case 'yearly':
                $startDate = now()->subYears(4)->startOfYear()->format('Y-m-d'); // 5 years data
                $endDate = now()->endOfYear()->format('Y-m-d');
                break;
            default:
                $startDate = now()->subWeeks(8)->startOfWeek()->format('Y-m-d');
                $endDate = now()->endOfWeek()->format('Y-m-d');
        }

        $query = DailyImpression::with(['adminTraffic'])
            ->whereHas('adminTraffic', function($q) {
                $q->where('category', 'Commuterline');
            })
            ->whereBetween('date', [$startDate, $endDate]);

        // Group data
        $data = $query->get()
            ->groupBy(function($item) {
                $date = Carbon::parse($item->date);

                switch ($this->timeRange) {
                    case 'daily':
                        return $date->format('Y-m-d');
                    case 'weekly':
                        return $date->startOfWeek()->format('Y-m-d') . ' to ' . $date->endOfWeek()->format('Y-m-d');
                    case 'monthly':
                        return $date->format('Y-m'); // Format as Year-Month for grouping
                    case 'yearly':
                        return $date->format('Y'); // Format as Year only for grouping
                }
            })
            ->map(function($items) {
                return $items->sum('impression');
            });

        // Format labels for display
        $labels = $data->keys()->map(function($key) {
            switch ($this->timeRange) {
                case 'weekly':
                    $parts = explode(' to ', $key);
                    $start = Carbon::parse($parts[0])->format('M d');
                    $end = Carbon::parse($parts[1])->format('M d');
                    return $start . ' - ' . $end;

                case 'monthly':
                    return Carbon::createFromFormat('Y-m', $key)->format('M Y'); // Format as "Month Year"

                case 'yearly':
                    return $key; // Just the year

                default: // daily
                    return Carbon::parse($key)->format('M d, Y');
            }
        })->toArray();

        $impressions = $data->values()->toArray();

        return view('livewire.commuterline-user-chart', [
            'labels' => $labels,
            'impressions' => $impressions,
            'timeRange' => $this->timeRange,
        ]);
    }
}
