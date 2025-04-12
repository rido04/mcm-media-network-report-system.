<?php

namespace App\Filament\Widgets;

use App\Models\DailyImpression;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class JakartaTrafficChart extends ChartWidget
{
    protected static ?string $heading = 'Jakarta Traffic';
    protected int | string | array $columnSpan = '50px';

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

    public function getMaxHeight(): string|null
    {
        return '200px';
    }

    public static ?int $sort = 6;

    protected function getData(): array
    {
        $userId = Auth::id();
        $category = 'Jakarta Traffic';

        $query = DailyImpression::query()
            ->whereHas('adminTraffic', function ($q) use ($userId, $category) {
                $q->where('user_id', $userId)
                  ->where('category', $category);
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
        $values = [];

        foreach ($data as $row) {
            $labels[] = $row->label;
            $values[] = $row->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Impressions',
                    'data' => $values,
                ],
            ],
            'labels' => $labels,
        ];
    }

    public function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y', // Membuat bar menjadi horizontal
            'scales' => [
                'x' => [
                    'beginAtZero' => true, // Mulai dari 0 pada sumbu X
                ],
                'y' => [
                    'ticks' => [
                        'autoSkip' => false, // Pastikan semua label ditampilkan
                    ],
                ],
            ],
        ];
    }
}
