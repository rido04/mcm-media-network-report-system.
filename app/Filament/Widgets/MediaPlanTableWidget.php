<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\MediaPlan;
use App\Models\MediaStatistic;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class MediaPlanTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Media Plan';
    protected static ?int $sort = 11;
    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
{
    return MediaStatistic::query()->with('user', 'dailyImpressions');
}
    public function table(Table $table): Table
    {
        return $table
            ->query(
                    MediaStatistic::query()
                        ->with(['user', 'dailyImpressions'])
                        ->selectRaw('media_statistics.*,
                            (SELECT SUM(impression) FROM daily_impressions
                            WHERE daily_impressions.media_statistic_id = media_statistics.id) as total_impression')
            )
            ->columns([
                TextColumn::make('media')->label('Media'),
                TextColumn::make('city')->label('Kota/Distrik'),
                TextColumn::make('start_date')->label('Mulai')->date(),
                TextColumn::make('end_date')->label('Selesai')->date(),

                TextColumn::make('remaining_days')
                    ->label('Remaining Days')
                    ->state(function ($record) {
                        return now()->diffInDays(Carbon::parse($record->end_date), false);
                    }),

                    TextColumn::make('total_impression')
                    ->label('Total Impression')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('start_date', 'desc')
            ->paginated([10, 25, 50]);
    }
}
