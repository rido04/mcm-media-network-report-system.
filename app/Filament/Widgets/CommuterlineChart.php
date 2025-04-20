<?php

namespace App\Filament\Widgets;

use App\Models\DailyImpression;
use App\Models\MediaStatistic;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class CommuterlineChart extends ChartWidget
{
    protected static ?string $heading = 'Commuterline User';
    protected int | string | array $columnSpan = 'full';
    public static ?int $sort = 5;
    public ?string $filter = 'daily';
    public ?string $cityFilter = null; // Tambahkan filter untuk kota

    protected function getFilters(): ?array
    {
        return [
            'yearly' => 'Yearly',
            'monthly' => 'Monthly',
            'weekly' => 'Weekly',
            'daily' => 'Daily',
        ];
    }

    // Tambahkan method untuk filter city
    protected function getExtraFilters(): ?array
    {
        $userId = Auth::id();

        // Ambil semua kota dari media statistics untuk user yang sedang login
        $cities = MediaStatistic::where('user_id', $userId)
            ->select('city')
            ->distinct()
            ->pluck('city')
            ->toArray();

        $options = ['all' => 'All Cities'];

        foreach ($cities as $city) {
            $options[$city] = $city;
        }

        return [
            'cityFilter' => [
                'label' => 'City',
                'options' => $options,
            ],
        ];
    }

    public function getMaxHeight(): string|null
    {
        return '200px';
    }

    protected function getData(): array
    {
        $userId = Auth::id();
        $category = 'Commuterline';

        $query = DailyImpression::query()
            ->whereHas('adminTraffic', function ($q) use ($userId, $category) {
                $q->where('user_id', $userId)
                  ->where('category', $category);
            });

        // Tambahkan filter berdasarkan city jika dipilih dan bukan 'all'
        if ($this->cityFilter && $this->cityFilter !== 'all') {
            $query->whereHas('mediaStatistic', function ($q) {
                $q->where('city', $this->cityFilter);
            });
        }

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

        // Tambahkan city ke heading jika ada filter city
        if ($this->cityFilter && $this->cityFilter !== 'all') {
            static::$heading = "Commuterline User - {$this->cityFilter}";
        } else {
            static::$heading = "Commuterline User";
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
