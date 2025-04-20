<?php

namespace App\Filament\Widgets;

use App\Models\AdPerformance;
use App\Models\MediaStatistic;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Filament\Support\RawJs;

class AdPerformanceChart extends ChartWidget
{
    protected static ?string $heading = 'Availability';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    // Tambahkan property untuk filter
    protected static bool $isFilterable = true;
    public ?string $filter = null;

    public function getMaxHeight(): ?string
    {
        return '500px';
    }

    // Tambahkan method untuk mendapatkan opsi filter
    protected function getFilters(): ?array
    {
        $cities = MediaStatistic::where('user_id', Auth::id())
            ->select('city')
            ->distinct()
            ->pluck('city')
            ->toArray();

        $options = ['all' => 'All Cities'];

        foreach ($cities as $city) {
            $options[$city] = $city;
        }

        return $options;
    }

    protected function getData(): array
    {
        // Query dasar
        $query = AdPerformance::with(['adminTraffic', 'mediaStatistic'])
            ->whereHas('adminTraffic', fn ($q) => $q->where('user_id', Auth::id()));

        // Tambahkan filter by city jika ada dan bukan 'all'
        if ($this->filter && $this->filter !== 'all') {
            $query->whereHas('mediaStatistic', function ($q) {
                $q->where('city', $this->filter);
            });
        }

        $data = $query->get()
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
