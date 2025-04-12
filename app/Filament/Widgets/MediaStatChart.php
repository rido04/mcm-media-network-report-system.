<?php

namespace App\Filament\Widgets;

use App\Models\DailyImpression;
use Filament\Widgets\ChartWidget;

class MediaStatChart extends ChartWidget
{
    protected static ?string $heading = 'Total Impression';
    protected static ?int $sort = 3;

    public function getColumnSpan(): array|int|string
    {
        return 'full'; // Gunakan 12 untuk lebar penuh, 6 untuk setengah, dll.
    }

    public function getMaxHeight(): string|null
    {
        return '200px';
    }

    public ?string $filter = 'daily';

    protected function getFilters(): ?array
    {
        return [
            'yearly' => 'Yearly',
            'monthly' => 'Monthly',
            'weekly' => 'Weekly',
            'daily' => 'Daily',
        ];
    }

    protected function getOptions(): array
    {
    return [
        'plugins' => [
            'background' => [
                'color' => 'grey', // Warna background widget
            ],
        ],
    ];
}


    protected function getData(): array
    {
        $query = DailyImpression::query();

        switch ($this->filter) {
            case 'yearly':
                $query->selectRaw('YEAR(date) as label, SUM(impression) as total')
                    ->groupBy('label');
                break;
            case 'monthly':
                $query->selectRaw('MONTHNAME(date) as label, SUM(impression) as total')
                    ->groupBy('label');
                break;
            case 'weekly':
                $query->selectRaw('WEEK(date, 1) as label, SUM(impression) as total')
                    ->groupBy('label');
                break;
            default:
                $query->selectRaw('DATE(date) as label, SUM(impression) as total')
                    ->groupBy('label');
                break;
        }

        $data = $query->orderBy('label')->get();

        $labels = [];
        $barValues = [];
        $lineValues = [];

        foreach ($data as $row) {
            $labels[] = $row->label;
            $barValues[] = $row->total; // Data untuk bar chart
            $lineValues[] = $row->total * 1.2; // Contoh data untuk line chart (modifikasi sesuai kebutuhan)
        }

        return [
            'datasets' => [
                [
                    'type' => 'bar', // Dataset untuk bar chart
                    'label' => 'Bar Data',
                    'data' => $barValues,
                    'backgroundColor' => '#3b82f6', //biru
                    'borderColor' => '#e5e7eb',
                    'borderWidth' => 1,
                ],
                [
                    'type' => 'line', // Dataset untuk line chart
                    'label' => 'Line Data',
                    'data' => $lineValues,
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'fill' => false,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Tipe utama chart
    }
    protected function getExtraAttributes(): array
{
    return [
        'class' => 'bg-white dark:bg-gray-800', // Light: putih, Dark: gray-800
    ];
}
}
