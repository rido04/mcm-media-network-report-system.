<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AdminTraffic;
use App\Models\MediaStatistic;
use App\Models\DailyImpression;
use Filament\Resources\Resource;
use Filament\Tables\Grouping\Group;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DailyImpressionResource\Pages;
use App\Filament\Resources\DailyImpressionResource\RelationManagers;

class DailyImpressionResource extends Resource
{
    protected static ?string $model = DailyImpression::class;
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?string $navigationGroup = 'Media';
    protected static ?string $navigationLabel = 'Impression';
    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->with(['adminTraffic.user']); // Eager loading
}

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('user_id')
                ->label('Client')
                ->options(fn () => User::whereHas('roles', fn($query) => $query->where('name', 'company'))
                    ->pluck('name', 'id')
                )
                ->reactive()
                ->required(),
            Select::make('media_statistic_id')
                ->label('City')
                ->reactive()
                ->options(function (callable $get) {
                    $userId = $get('user_id');

                    if (!$userId) {
                        return [];
                    }

                    return MediaStatistic::where('user_id', $userId)
                        ->select('id', 'city')
                        ->distinct()
                        ->pluck('city', 'id'); // key = value that you input
                })
                ->required(),
            Select::make('admin_traffic_id')
                ->label('Category')
                ->reactive()
                ->options(function (callable $get) {
                    $cityId = $get('media_statistic_id');
                    if (!$cityId) {
                        return [];
                    }
                    // adjust query
                    return AdminTraffic::whereHas('mediaStatistic', function ($query) use ($cityId) {
                        $query->where('id', $cityId);
                    })->pluck('Category', 'id');
                })
                ->required(),
            Select::make('media_statistic_id')
                ->label('Media Plan')
                ->options(function (callable $get) {
                    $userId = $get('user_id');
                    if (!$userId) {
                        return [];
                    }
                    return MediaStatistic::where('user_id', $userId)
                        ->select('id', 'media')
                        ->distinct()
                        ->pluck('media', 'id');
                    })
                ->required(),
            DatePicker::make('date')
                ->label('Date')
                ->required(),
            TextInput::make('impression')
                ->label('Total Impression')
                ->numeric()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->groups([
            Group::make('adminTraffic.category')
            ->label('Category')
        ])
            ->columns([
            TextColumn::make('adminTraffic.user.name')
                ->label('Client')
                ->searchable(),
            TextColumn::make('mediaStatistic.media')
                ->label('Media Plan')
                ->searchable(),
            TextColumn::make('mediaStatistic.city')
                ->label('City/District')
                ->searchable(),
            TextColumn::make('adminTraffic.category')
                ->label('Category')
                ->searchable(),
            TextColumn::make('date')
                ->label('Date')
                ->sortable()
                ->date(),
            TextColumn::make('impression')
                ->label('Daily Impression'),
                ])->defaultSort('date', 'desc')
            ->filters([
            SelectFilter::make('client')
                ->label('Client')
                ->multiple()
                ->options(fn () => User::whereHas('roles', fn($query) => $query->where('name', 'company'))
                    ->pluck('name', 'id')
                )
                ->query(function (Builder $query, array $data) {
                    if (empty($data['values'])) {
                        return $query;
                    }
                    return $query->whereHas('adminTraffic.user', function ($query) use ($data) {
                        $query->whereIn('users.id', $data['values']);
                    });
                }),
            SelectFilter::make('category')
                ->label('Category')
                ->relationship('adminTraffic','category'),
            SelectFilter::make('mediaStatistic.city')
                ->relationship('mediaStatistic', 'city')
                ->label('City/District')
            ])
            ->actions([
                EditAction::make(),
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
            'index' => Pages\ListDailyImpressions::route('/'),
            'create' => Pages\CreateDailyImpression::route('/create'),
            'edit' => Pages\EditDailyImpression::route('/{record}/edit'),
        ];
    }
}
