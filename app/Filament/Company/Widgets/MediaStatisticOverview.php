<?php

namespace App\Filament\Company\Widgets;

use App\Models\MediaStatistic;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class MediaStatisticOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '5s'; // Auto-refresh setiap 5 detik

    protected function getCards(): array
    {
        $user = Auth::user();

        $mediaStats = MediaStatistic::where('user_id', $user->id)->get();

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

            // Hanya tambahkan jika tanggal sekarang <= end_date
            if ($now->lessThanOrEqualTo($end)) {
                $carry += floor($now->diffInDays($end));
            }

            return $carry;
        }, 0);

        return [
            Card::make('Total Media Plan', $totalMediaPlan)
                ->description('Media plan aktif')
                ->color('primary'),

            Card::make('Total Inventory', $totalInventory)
                ->description('Media placement')
                ->color('success'),

            Card::make('Durasi Penayangan', "{$totalDuration} Hari")
                ->description('Total durasi')
                ->color('info'),

            Card::make('Sisa Hari Penayangan', "{$remainingDays} Hari")
                ->description('Iklan yang masih aktif')
                ->color('warning'),
        ];
    }
}
