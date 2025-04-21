<?php

namespace App\Filament\Company\Widgets;

use App\Models\MediaStatistic;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class MediaStatisticOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '5s'; // automatically refresh every 5 seconds
    protected static ?int $sort = 2;
    protected $listeners = ['refreshStatsWidget' => '$refresh'];
    protected function getCards(): array
    {
        $user = Auth::user();

        $filtersData = session('filters', []);
        $filters = $filtersData['filters'] ?? [];
        $mediaStats = MediaStatistic::where('user_id', $user->id)
        ->when($filters['start_date'] ?? null, fn($q, $val) => $q->whereDate('start_date', '>=', $val))
        ->when($filters['end_date'] ?? null, fn($q, $val) => $q->whereDate('end_date', '<=', $val))
        ->when($filters['media'] ?? null, fn($q, $val) => $q->where('media', $val))
        ->when($filters['city'] ?? null, fn($q, $val) => $q->where('city', 'like', "%$val%"))
        ->get();

        $totalMediaPlan = $mediaStats->count();
        $totalInventory = $mediaStats->pluck('media_placement')->count();

        $totalDuration = $mediaStats->reduce(function ($carry, $item) {
            $start = Carbon::parse($item->start_date);
            $end = Carbon::parse($item->end_date);
            return $carry + $start->diffInDays($end);
        }, 0);

        $remainingDays = $mediaStats->reduce(function ($carry, $item) {
            $now = now();
            $end = Carbon::parse($item->end_date);

            // Only use if now date <= end date
            if ($now->lessThanOrEqualTo($end)) {
                $carry += floor($now->diffInDays($end));
            }

            return $carry;
        }, 0);

        return [
            Card::make('Media Plan', $totalMediaPlan)
                ->color('primary'),

            Card::make('Media Placement', $totalInventory)
                ->color('success'),

            Card::make('Broadcast Duration', "{$totalDuration} Days")
                ->color('info'),

            Card::make('Remaining Days', "{$remainingDays} Days")
                ->color('warning'),
        ];
    }
}
