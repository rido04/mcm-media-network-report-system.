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
    protected static ?string $pollingInterval = '5s'; // Auto-refresh setiap 5 detik

    protected static ?int $sort = 1;
    protected $listeners = ['refreshStatsWidget' => '$refresh'];
    protected function getCards(): array
    {
        $user = Auth::user();

        $filtersData = session('filters', []);
        $filters = $filtersData['filters'] ?? [];
        Log::info('FILTER FINAL YANG DIPAKAI DI QUERY', $filters);

        Log::info('Session filters di widget statistik:', $filters);

        $mediaStats = MediaStatistic::where('user_id', $user->id)
        ->when($filters['start_date'] ?? null, fn($q, $val) => $q->whereDate('start_date', '>=', $val))
        ->when($filters['end_date'] ?? null, fn($q, $val) => $q->whereDate('end_date', '<=', $val))
        ->when($filters['media_plan'] ?? null, fn($q, $val) => $q->where('media_plan', $val))
        ->when($filters['city'] ?? null, fn($q, $val) => $q->where('city', 'like', "%$val%"))
        ->when($filters['media_placement'] ?? null, fn($q, $val) => $q->where('media_placement', 'like', "%$val%"))
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
