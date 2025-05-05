<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\DailyImpression;
use Illuminate\Support\Facades\Auth;

class RoadTraffic extends Component
{
    public $timeRange = 'daily'; // default filter
    public $userId;
    protected $listeners = ['refreshChart'];

    public function mount()
    {
        // Mengambil ID user yang sedang login
        $this->userId = Auth::id();
    }

    public function changeTimeRange($range)
    {
        $this->timeRange = $range;
        $this->dispatch('timeRangeChanged');
    }

    /**
     * Get date range based on selected time range
     *
     * @return array [$startDate, $endDate]
     */
    private function getDateRange()
    {
        switch ($this->timeRange) {
            case 'daily':
                return [null, null];
            case 'weekly':
                return [
                    now()->subWeeks(8)->startOfWeek()->format('Y-m-d'),
                    now()->endOfWeek()->format('Y-m-d')
                ];
            case 'monthly':
                return [
                    now()->subMonths(11)->startOfMonth()->format('Y-m-d'),
                    now()->endOfMonth()->format('Y-m-d')
                ];
            case 'yearly':
                return [
                    now()->subYears(4)->startOfYear()->format('Y-m-d'),
                    now()->endOfYear()->format('Y-m-d')
                ];
            default:
                return [
                    now()->subWeeks(8)->startOfWeek()->format('Y-m-d'),
                    now()->endOfWeek()->format('Y-m-d')
                ];
        }
    }

    /**
     * Format date for grouping based on time range
     *
     * @param Carbon $date
     * @return string
     */
    private function formatDateForGrouping($date)
    {
        switch ($this->timeRange) {
            case 'daily':
                return $date->format('Y-m-d');
            case 'weekly':
                return $date->startOfWeek()->format('Y-m-d') . ' to ' . $date->endOfWeek()->format('Y-m-d');
            case 'monthly':
                return $date->format('Y-m');
            case 'yearly':
                return $date->format('Y');
            default:
                return $date->format('Y-m-d'); // Default to daily format
        }
    }

    public function render()
    {
        [$startDate, $endDate] = $this->getDateRange();

        $query = DailyImpression::with(['adminTraffic'])
            ->whereHas('adminTraffic', function($q) {
                $q->where('category', ['DOOH', 'OOH'])
                  ->where('user_id', $this->userId); // Filter user_id melalui relasi adminTraffic
            });

            if ($startDate && $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            }

        // Group data
        $data = $query->get()
            ->groupBy(function($item) {
                $date = Carbon::parse($item->date);
                return $this->formatDateForGrouping($date);
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
                    return Carbon::createFromFormat('Y-m', $key)->format('M Y');
                case 'yearly':
                    return $key;
                default: // daily
                    return Carbon::parse($key)->format('M d, Y');
            }
        })->toArray();

        $impressions = $data->values()->toArray();

        return view('livewire.road-traffic', [
            'labels' => $labels,
            'impressions' => $impressions,
            'timeRange' => $this->timeRange,
        ]);
    }
}
