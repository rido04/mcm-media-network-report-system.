<?php

namespace App\Filament\Widgets;

use App\Models\AdminTraffic;
use App\Models\AdPerformance;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\BarChartWidget;
use Illuminate\Support\Facades\Auth;

class AdPerformanceChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = '50px';

    protected function getMaxHeight(): ?string
    {
        return '500px';
    }

    protected function getData(): array
    {
        $userId = Auth::id();

        $adminTraffics = AdminTraffic::where('user_id', $userId)->get()->groupBy('category');

        $commuterlineIds = $adminTraffics->get('Commuterline', collect())->pluck('id');
        $transjakartaIds = $adminTraffics->get('Transjakarta', collect())->pluck('id');

        $trafficIds = collect()
            ->merge($adminTraffics->get('DOOH', collect())->pluck('id'))
            ->merge($adminTraffics->get('OOH', collect())->pluck('id'));

        $commuterlineSum = AdPerformance::whereIn('admin_traffic_id', $commuterlineIds)->sum('performance');
        $transjakartaSum = AdPerformance::whereIn('admin_traffic_id', $transjakartaIds)->sum('performance');
        $trafficSum = AdPerformance::whereIn('admin_traffic_id', $trafficIds)->sum('performance');

        return [
            'datasets' => [
                [
                    'label' => 'Ad Performance',
                    'data' => [
                        $transjakartaSum,
                        $commuterlineSum,
                        $trafficSum,
                    ],
                    'backgroundColor' => [
                        'rgba(16, 185, 129, 0.7)',    // Transjakarta (hijau)
                        'rgba(59, 130, 246, 0.7)',    // Commuterline (biru)
                        'rgba(234, 88, 12, 0.7)',     // Traffic (oranye)
                    ],
                ],
            ],
            'labels' => ['Transjakarta', 'Commuterline', 'Traffic (OOH + DOOH)'],
        ];
    }

    public function getType():string
    {
        return 'bar';
    }
}
