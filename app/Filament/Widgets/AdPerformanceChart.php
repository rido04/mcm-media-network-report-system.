<?php
namespace App\Filament\Widgets;

use App\Models\AdminTraffic;
use App\Models\AdPerformance;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class AdPerformanceChart extends ChartWidget
{
    protected static string $view = 'filament.widgets.ad-performance-chart';
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;
    protected function getType(): string
    {
        return 'bar'; // bisa juga line, depending kebutuhan
    }

    protected function getData(): array
    {
        $userId = Auth::id();

        // Ambil semua AdminTraffic untuk user ini
        $adminTrafficIds = AdminTraffic::where('user_id', $userId)->pluck('id', 'category');

        $commuterline = AdPerformance::whereIn('admin_traffic_id', [$adminTrafficIds['Commuterline'] ?? 0])
            ->orderBy('date')
            ->get()
            ->groupBy('date')
            ->map(fn ($group) => $group->sum('performance'));

        $transjakarta = AdPerformance::whereIn('admin_traffic_id', [$adminTrafficIds['Transjakarta'] ?? 0])
            ->orderBy('date')
            ->get()
            ->groupBy('date')
            ->map(fn ($group) => $group->sum('performance'));

        $trafficIds = collect(['DOOH', 'OOH'])->map(fn ($cat) => $adminTrafficIds[$cat] ?? null)->filter();
        $traffic = AdPerformance::whereIn('admin_traffic_id', $trafficIds)
            ->orderBy('date')
            ->get()
            ->groupBy('date')
            ->map(fn ($group) => $group->sum('performance'));

        // Gabungkan semua label tanggal
        $labels = $commuterline->keys()
            ->merge($transjakarta->keys())
            ->merge($traffic->keys())
            ->unique()
            ->sort()
            ->values();

        return [
            'labels' => $labels->toArray(),
            'datasets' => [
                [
                    'label' => 'Commuterline',
                    'data' => $labels->map(fn ($date) => $commuterline[$date] ?? 0),
                    'backgroundColor' => 'rgba(59, 130, 246, 0.7)',
                ],
                [
                    'label' => 'Transjakarta',
                    'data' => $labels->map(fn ($date) => $transjakarta[$date] ?? 0),
                    'backgroundColor' => 'rgba(16, 185, 129, 0.7)',
                ],
                [
                    'label' => 'Traffic (DOOH + OOH)',
                    'data' => $labels->map(fn ($date) => $traffic[$date] ?? 0),
                    'backgroundColor' => 'rgba(234, 88, 12, 0.7)',
                ],
            ],
        ];
    }
}
