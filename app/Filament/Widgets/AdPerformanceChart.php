<?php

namespace App\Filament\Widgets;

use App\Models\AdminTraffic;
use App\Models\AdPerformance;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use App\Models\MediaStatistic;

class AdPerformanceChart extends ChartWidget
{
    protected static ?string $heading = 'Total Impression';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public function getMaxHeight(): string|null
    {
        return '500px';
    }
    protected function getFilters(): ?array
    {
        return [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
        ];
    }

    protected function getData(): array
    {
        $data = AdPerformance::with(['adminTraffic.user'])
            ->whereHas('adminTraffic', fn($q) => $q->where('user_id', Auth::id()))
            ->select([
                'admin_traffic_id',
                'used_placement',
                'available_placement'
            ])
            ->get()
            ->groupBy('adminTraffic.category');

        $datasets = [];
        $labels = [];

        foreach ($data as $category => $performances) {
            $labels[] = $category;
            $datasets['used'][] = $performances->sum('used_placement');
            $datasets['available'][] = $performances->sum('available_placement');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Used Placement',
                    'data' => $datasets['used'] ?? [],
                    'backgroundColor' => '#3b82f6',
                    'borderColor' => '#2563eb',
                    'borderWidth' => 1,
                    'borderRadius' => 4,
                ],
                [
                    'label' => 'Available Placement',
                    'data' => $datasets['available'] ?? [],
                    'backgroundColor' => '#d1d5db',
                    'borderColor' => '#9ca3af',
                    'borderWidth' => 1,
                    'borderRadius' => 4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'stacked' => false, // Bar berdampingan
                    'grid' => ['display' => false],
                ],
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => ['stepSize' => 1],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                    'labels' => ['boxWidth' => 12],
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                    'callbacks' => [
                        'label' => 'function(context) {
                            return context.dataset.label + ": " + context.parsed.y + " placements";
                        }'
                    ]
                ]
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
        ];
    }

    public function getType(): string
    {
        return 'bar';
    }
}
