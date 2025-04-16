<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MediaStatistic;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MediaStatisticResource\Pages;
use App\Filament\Resources\MediaStatisticResource\RelationManagers;

class MediaStatisticResource extends Resource
{
    protected static ?string $model = MediaStatistic::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function getPluralLabel(): ?string
    {
        return 'Media Plan';
    }

    protected static ?string $navigationGroup = 'Media';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                ->label('Perusahaan')
                ->options(User::whereHas('roles', fn($q) => $q->where('name', 'company'))
                    ->pluck('name', 'id'))
                ->searchable()
                ->required(),
                TextInput::make('media')
                ->label('Media')
                ->required(),
            DatePicker::make('start_date')
                ->label('Tanggal Mulai')
                ->required(),

            DatePicker::make('end_date')
                ->label('Tanggal Selesai')
                ->required(),

            TextInput::make('city')
                ->label('Kota/Distrik')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
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
            TextColumn::make('user.name')
                ->label('Perusahaan')
                ->sortable(),

            TextColumn::make('media')
                ->label('Media')
                ->sortable()
                ->searchable(),

            TextColumn::make('city')
                ->label('Kota/Distrik')
                ->sortable()
                ->searchable(),

            TextColumn::make('start_date')
                ->label('Mulai')
                ->date()
                ->sortable(),

            TextColumn::make('end_date')
                ->label('Selesai')
                ->date()
                ->sortable(),

            // Total Impression
            TextColumn::make('total_impression')
                ->label('Total Impression')
                ->numeric()
                ->sortable()
                ->toggleable(),

            // Rata-rata per hari (contoh tambahan)
            TextColumn::make('avg_impression')
                ->label('Rata-rata/Hari')
                ->state(function ($record) {
                    $days = $record->dailyImpressions->count();
                    return $days > 0 ? number_format($record->total_impression / $days, 2) : 0;
                })
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            // Tambahkan filter jika perlu
        ])
        ->actions([
            EditAction::make(),
            DeleteAction::make()
        ])
        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaStatistics::route('/'),
            'create' => Pages\CreateMediaStatistic::route('/create'),
            'edit' => Pages\EditMediaStatistic::route('/{record}/edit'),
        ];
    }
}
