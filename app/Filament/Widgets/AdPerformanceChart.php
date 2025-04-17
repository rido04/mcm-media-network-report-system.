<?php

namespace App\Filament\Widgets;

use App\Models\AdPerformance;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Filament\Support\RawJs;

class AdPerformanceChart extends ChartWidget
{
    protected static ?string $heading = 'Availability';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public function getMaxHeight(): ?string
    {
        return '500px';
    }

    protected function getData(): array
    {
        $data = AdPerformance::with('adminTraffic')
            ->whereHas('adminTraffic', fn ($q) => $q->where('user_id', Auth::id()))
            ->get()
            ->groupBy(fn ($item) => $item->adminTraffic->category ?? 'Unknown');

        $labels = [];
        $used = [];
        $available = [];

        foreach ($data as $category => $items) {
            $labels[] = $category;
            $used[] = $items->sum('used_placement');
            $available[] = $items->sum('available_placement');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Used Placement',
                    'data' => $used,
                    'borderWidth' => 2,
                    'borderRadius' => 4,
                    'backgroundColor' => '#9BD0F5',
                    'barThickness' => 30,
                ],
                [
                    'label' => 'Available Placement',
                    'data' => $available,
                    'borderWidth' => 2,
                    'borderRadius' => 4,
                    'barThickness' => 30,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'interaction' => [
                'mode' => 'index',
                'intersect' => false,
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
                'tooltip' => [
                    'enabled' => true,
                    'mode' => 'index',
                    'intersect' => false,
                    'callbacks' => [
                        'label' => RawJs::make(<<<'JS'
                            function(context) {
                                const value = context.parsed.y !== undefined ? context.parsed.y : context.parsed;
                                return context.dataset.label + ": " + value + " placements";
                            }
                        JS),
                    ],
                ],
            ],
            'scales' => [
                'x' => [
                    'stacked' => false,
                    'grid' => ['display' => false],
                ],
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => ['stepSize' => 1],
                ],
            ],
        ];
    }

    public function getType(): string
    {
        return 'bar';
    }
}
