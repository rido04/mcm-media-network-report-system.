<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\MediaStatistic;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\TableWidget as BaseWidget;

class MediaStatisticTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Media Statistics';
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 10;
    public function table(Table $table): Table
    {
        return $table
            ->query(MediaStatistic::where('user_id', Auth::id()))
            ->columns([
                Tables\Columns\TextColumn::make('media_plan')
                    ->label('Media Plan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('media_placement')
                    ->label('Placement')
                    ->searchable(),

                Tables\Columns\TextColumn::make('city')
                    ->label('Kota')
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Selesai')
                    ->date()
                    ->sortable(),
            ])
            ->defaultSort('start_date', 'desc')
            ->paginated([10, 25, 50]);
    }
}
