<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\DailyImpression;

class Transjakarta extends Component
{
    public $timeRange = 'daily'; // daily, weekly, monthly

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
        // Hitung date range berdasarkan timeRange yang dipilih
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
                $startDate = now()->subMonths(6)->startOfMonth()->format('Y-m-d');
                $endDate = now()->endOfMonth()->format('Y-m-d');
                break;
            default:
                $startDate = now()->subWeeks(8)->startOfWeek()->format('Y-m-d');
                $endDate = now()->endOfWeek()->format('Y-m-d');
        }

        $query = DailyImpression::with(['adminTraffic'])
            ->whereHas('adminTraffic', function($q) {
                $q->where('category', 'Transjakarta');
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
                        return $date->format('Y-m');
                }
            })
            ->map(function($items) {
                return $items->sum('impression');
            });

        // Format labels
        $labels = $data->keys()->map(function($key) {
            if ($this->timeRange === 'weekly') {
                $parts = explode(' to ', $key);
                $start = Carbon::parse($parts[0])->format('M d');
                $end = Carbon::parse($parts[1])->format('M d');
                return $start . ' - ' . $end;
            }
            return $key;
        })->toArray();

        $impressions = $data->values()->toArray();

        return view('livewire.transjakarta', [
            'labels' => $labels,
            'impressions' => $impressions,
            'timeRange' => $this->timeRange,
        ]);
    }
}
