<?php

namespace App\Filament\Widgets;

use App\Models\DailyImpression;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ImpressionStats extends BaseWidget
{
    protected static ?int $sort = 3;

    // Listen ke event filter global
    protected $listeners = ['refreshStatsWidget' => '$refresh'];

    protected function getCards(): array
    {
        $userId = Auth::id();

        // Get filter form session
        $filters = session('filters', []);

        $query = DailyImpression::whereHas('adminTraffic', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });

        if (!empty($filters['start_date'])) {
            $query->whereDate('date', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('date', '<=', $filters['end_date']);
        }

        if (!empty($filters['media_statistic_id']) && $filters['media_statistic_id'] !== 'all') {
            $query->where('media_statistic_id', $filters['media_statistic_id']);
        }

        return [
            Card::make('Highest Impression', number_format($query->max('impression')))
                ->color('success'),

            Card::make('Lowest Impression', number_format($query->min('impression')))
                ->color('danger'),

            Card::make('Average Impression', number_format($query->avg('impression'), 2))
                ->color('info'),

            Card::make('Total Impression', number_format($query->sum('impression')))
                ->color('primary'),
        ];
    }
}
