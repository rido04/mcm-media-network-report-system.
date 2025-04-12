<?php

namespace App\Filament\Company\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MediaStatistic;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Company\Resources\MediaStatisticResource\Pages;
use App\Filament\Company\Resources\MediaStatisticResource\RelationManagers;

class MediaStatisticResource extends Resource
{
    protected static ?string $model = MediaStatistic::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function getPluralLabel(): ?string
    {
        return 'Advertising Dashboard';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
        }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('media_plan')->label('Media Plan'),
            TextColumn::make('media_placement')->label('Placement'),
            TextColumn::make('city')->label('Kota'),
            TextColumn::make('start_date')->label('Mulai')->date(),
            TextColumn::make('end_date')->label('Selesai')->date(),
            ])->defaultSort('start_date', 'desc')
            ->filters([
            ])
            ->actions([
            ])
            ->bulkActions([
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
