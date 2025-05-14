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
use Filament\Tables\Filters\SelectFilter;
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
                ->label('Client')
                ->options(User::whereHas('roles', fn($q) => $q->where('name', 'company'))
                    ->pluck('name', 'id'))
                ->searchable()
                ->required(),
            TextInput::make('media')
                ->label('Media Plan')
                ->required(),
            DatePicker::make('start_date')
                ->label('Start Date')
                ->required(),
            DatePicker::make('end_date')
                ->label('End Date')
                ->required(),
            TextInput::make('city')
                ->label('City/District')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->query(
            MediaStatistic::query()
                ->with(['user', 'dailyImpressions'])
                // query form relation with media_statistics
                ->selectRaw('media_statistics.*,
                    (SELECT SUM(impression) FROM daily_impressions
                    WHERE daily_impressions.media_statistic_id = media_statistics.id) as total_impression')
                )
                ->columns([
            TextColumn::make('user.name')
                ->label('Client')
                ->searchable()
                ->sortable(),
            TextColumn::make('media')
                ->label('Media Plan')
                ->sortable()
                ->searchable(),
            TextColumn::make('city')
                ->label('City/District')
                ->sortable()
                ->searchable(),
            TextColumn::make('start_date')
                ->label('Start')
                ->date()
                ->sortable(),
            TextColumn::make('end_date')
                ->label('End')
                ->date()
                ->sortable(),
            TextColumn::make('total_impression')
                ->label('Total Impression')
                ->numeric()
                ->sortable()
                ->toggleable(),
                TextColumn::make('total_impression')
                ->label('Total Impression')
                ->getStateUsing(fn ($record) => number_format($record->mediaPlacements()->sum('avg_daily_impression')))
        ])
        ->filters([
            SelectFilter::make('client')
                ->label('Client')
                //query to user with role company permission
                ->options(fn () => User::whereHas('roles', fn($query) => $query->where('name', 'company'))
                    ->pluck('name', 'id')
                )
                ->query(function (Builder $query, array $data) {
                    if (!$data['value']) {
                        return $query;
                    }

                    return $query->where('user_id', $data['value']);
                }),
                SelectFilter::make('city')
                ->label('City')
                ->options(function () {
                    return MediaStatistic::distinct()->pluck('city', 'city');
                })
                ->query(function (Builder $query, array $data) {
                    if (!$data['value']) {
                        return $query;
                    }

                    return $query->where('city', $data['value']);
                })
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
