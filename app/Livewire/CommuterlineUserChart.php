<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\DailyImpression;
use Illuminate\Support\Facades\Auth;

class CommuterlineUserChart extends Component
{
        public $timeRange = 'daily'; // daily, weekly, monthly, yearly
        protected $listeners = ['timeRangeChanged' => '$refresh'];
        protected $queryString = ['timeRange'];

        public function mount()
        {
            //
        }

        public function changeTimeRange($range)
        {
            $this->timeRange = $range;
            $this->dispatch('timeRangeChanged');
        }

        public function updatedTimeRange()
        {
            $this->dispatch('timeRangeChanged');
        }

        public function getChartData()
        {
            $cacheKey = 'commuterline_stats'.Auth::id().'_'.$this->timeRange;

            return cache()->remember($cacheKey, now()->addMinutes(30), function() {
                $rangeData = $this->getDateRange();

                $query = DailyImpression::with(['adminTraffic'])
                        ->whereHas('adminTraffic', function($q) {
                            $q->where('category', 'Commuterline')
                            ->where('user_id', Auth::id());
                        })
                    ->whereBetween('date', [$rangeData['startDate'], $rangeData['endDate']]);

                // Use database groupping for monthly adn yearly
                if (in_array($this->timeRange, ['monthly', 'yearly'])) {
                    return $this->getDatabaseGroupedData($query, $rangeData['groupFormat']);
                }

                return $this->getPhpGroupedData($query);
            });
        }

        protected function getDatabaseGroupedData($query, $groupFormat)
        {
            $groupByExpression = match($this->timeRange) {
                'monthly' => "DATE_FORMAT(date, '%Y-%m')",
                'yearly' => "DATE_FORMAT(date, '%Y')",
                default => 'date'
            };

            $data = $query->selectRaw("
                    {$groupByExpression} as group_date,
                    SUM(impression) as total_impression
                ")
                ->groupBy('group_date')
                ->orderBy('group_date')
                ->get()
                ->mapWithKeys(function($item) {
                    return [$item->group_date => $item->total_impression];
                });

            return [
                'labels' => $this->formatLabels($data->keys()),
                'impressions' => $data->values()->toArray()
            ];
        }

        protected function getPhpGroupedData($query)
        {
            $data = $query->get()
                ->groupBy(function($item) {
                    $date = Carbon::parse($item->date);

                    return match ($this->timeRange) {
                        'daily' => $date->format('Y-m-d'),
                        'weekly' => $date->startOfWeek()->format('Y-m-d').' to '.$date->endOfWeek()->format('Y-m-d'),
                        'monthly' => $date->format('Y-m'),
                        'yearly' => $date->format('Y'),
                        default => $date->format('Y-m-d')
                    };
                })
                ->map(fn($items) => $items->sum('impression'));

            return [
                'labels' => $this->formatLabels($data->keys()),
                'impressions' => $data->values()->toArray()
            ];
        }

        protected function getDateRange()
        {
            return match ($this->timeRange) {
                'daily' => [
                    'startDate' => now()->subDays(7)->format('Y-m-d'),
                    'endDate' => now()->format('Y-m-d'),
                    'groupFormat' => 'Y-m-d'
                ],
                'weekly' => [
                    'startDate' => now()->subWeeks(8)->startOfWeek()->format('Y-m-d'),
                    'endDate' => now()->endOfWeek()->format('Y-m-d'),
                    'groupFormat' => 'week'
                ],
                'monthly' => [
                    'startDate' => now()->subMonths(11)->startOfMonth()->format('Y-m-d'),
                    'endDate' => now()->endOfMonth()->format('Y-m-d'),
                    'groupFormat' => 'Y-m'
                ],
                'yearly' => [
                    'startDate' => now()->subYears(4)->startOfYear()->format('Y-m-d'),
                    'endDate' => now()->endOfYear()->format('Y-m-d'),
                    'groupFormat' => 'Y'
                ],
                default => [
                    'startDate' => now()->subWeeks(8)->startOfWeek()->format('Y-m-d'),
                    'endDate' => now()->endOfWeek()->format('Y-m-d'),
                    'groupFormat' => 'week'
                ]
            };
        }

        protected function formatLabels($labels)
        {
            return $labels->map(function($key) {
                return match ($this->timeRange) {
                    'weekly' => $this->formatWeeklyLabel($key),
                    'monthly' => Carbon::createFromFormat('Y-m', $key)->format('M Y'),
                    'yearly' => $key,
                    default => Carbon::parse($key)->format('M d, Y')
                };
            })->toArray();
        }

        protected function formatWeeklyLabel($key)
        {
            $parts = explode(' to ', $key);
            $start = Carbon::parse($parts[0])->format('M d');
            $end = Carbon::parse($parts[1])->format('M d');
            return $start.' - '.$end;
        }

        public function render()
        {
            $chartData = $this->getChartData();

            return view('livewire.commuterline-user-chart', [
                'labels' => $chartData['labels'],
                'impressions' => $chartData['impressions'],
                'timeRange' => $this->timeRange,
            ]);
        }
}
