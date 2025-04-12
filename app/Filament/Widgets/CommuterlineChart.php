<?php

namespace App\Filament\Widgets;

use App\Models\DailyImpression;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class CommuterlineChart extends ChartWidget
{
    protected static ?string $heading = 'Commuterline User';
    protected int | string | array $columnSpan = 'full';

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

    public static ?int $sort = 4;

    protected function getData(): array
    {
        $userId = Auth::id();
        $category = 'Commuterline';

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
}
