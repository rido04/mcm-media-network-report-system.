<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\PlayLog;
use Filament\Tables\Table;
use App\Models\MediaPlacement;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class PlayLogTableWidget extends BaseWidget
{

    protected static ?string $heading = 'Play Log';
    protected function getTableQuery(): Builder
    {
        return PlayLog::query()
        ->where('user_id', Auth::id())
        ->latest();
    }

    protected int|string|array $columnSpan = 'full';

    protected static?int $sort = 12;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                $this->getTableQuery()
            )
            ->columns([
                TextColumn::make('device_id')
                ->label('Device ID')
                ->searchable(),
                TextColumn::make('media_name')
                ->label('Media Name')
                ->searchable(),
                TextColumn::make('play_date')
                ->label('Play Date')
                ->searchable(),
                TextColumn::make('longitude')
                ->label('Longitude')
                ->searchable(),
                TextColumn::make('latitude')
                ->label('Latitude')
                ->searchable(),
                TextColumn::make('location')
                ->label('Location')
                ->searchable(),
            ]);
    }
}
