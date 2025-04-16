<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DailyImpression;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
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
                ->label('Perusahaan')
                ->options(fn () => User::whereHas('roles', fn($query) => $query->where('name', 'company'))
                ->pluck('name', 'id')
                )
                ->required(),
            Select::make('admin_traffic_id')
                ->label('Kategori')
                ->relationship('adminTraffic', 'category')
                ->required(),
            Select::make('media_statistic_id')
                ->label('Media Plan')
                ->relationship('mediaStatistic', 'media')
                ->required(),

            DatePicker::make('date')
                ->label('Tanggal')
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
            ->columns([
            TextColumn::make('adminTraffic.user.name')->label('Perusahaan'),
            TextColumn::make('adminTraffic.category')->label('Kategori'),
            TextColumn::make('date')->label('Tanggal')->date(),
            TextColumn::make('impression')->label('Total Impression'),
            ])->defaultSort('date', 'desc')
            ->filters([
                SelectFilter::make('admin_traffic_id')
                    ->label('Perusahaan')
                    ->relationship('adminTraffic.user', 'name')
                    ->searchable()
                    ->preload()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
