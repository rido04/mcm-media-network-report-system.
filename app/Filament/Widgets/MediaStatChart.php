<?php

namespace App\Filament\Widgets;

use App\Models\DailyImpression;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class MediaStatChart extends ChartWidget
{
    protected static ?string $heading = 'Performance';
    protected static ?int $sort = 7;
    public function getColumnSpan(): array|int|string
    {
        return 'full'; // //use 'full' to make the chart full width
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
        $query = DailyImpression::whereHas('adminTraffic', function ($q) {
            $q->where('user_id', Auth::id());
        });

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
            $barValues[] = $row->total; // Data for bar chart
            $lineValues[] = $row->total * 1.2; // data for line chart
        }

        return [
            'datasets' => [
                [
                    'type' => 'bar', // Dataset for bar chart
                    'label' => 'Bar Data',
                    'data' => $barValues,
                    'borderWidth' => 1,
                ],
                [
                    'type' => 'line', // Dataset for line chart
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
