<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\AdminTraffic;
use App\Models\MediaPlacement;
use App\Models\MediaStatistic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class MediaStatisticTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Media Placement';
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 10;
    protected function getTableQuery(): Builder
    {
        return MediaPlacement::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('media')
                ->label('Media')
                ->searchable()
                ->sortable(),

            TextColumn::make('adminTraffic.category')
                ->label('Kategori')
                ->searchable()
                ->sortable(),

            TextColumn::make('space_ads')
                ->label('Space Ads'),

            TextColumn::make('size')
                ->label('Size'),

            TextColumn::make('dailyImpression.impression')
                ->label('Daily Impression'),
        ];
    }

    protected function getTableFilters(): array
{
    return [
        SelectFilter::make('media')
            ->label('Filter Media')
            ->options(
                MediaPlacement::query()
                    ->select('media')
                    ->distinct()
                    ->pluck('media', 'media')
            )
            ->searchable()
            ->placeholder('Semua Media'),
    ];
}

}
