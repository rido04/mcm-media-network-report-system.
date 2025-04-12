<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AdminTraffic;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AdminTrafficResource\Pages;
use App\Filament\Resources\AdminTrafficResource\RelationManagers;
use App\Filament\Resources\AdminTrafficResource\RelationManagers\DailyImpressionsRelationManager;
use Filament\Tables\Filters\SelectFilter;

class AdminTrafficResource extends Resource
{
    protected static ?string $model = AdminTraffic::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function getPluralLabel():string
    {
        return 'Traffic';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('category')
                ->label('Kategori')
                ->required(),
                Select::make('user_id')
                ->label('Perusahaan')
                ->options(fn () => User::whereHas('roles', fn($query) => $query->where('name', 'company'))
                    ->pluck('name', 'id')
                )
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Perusahaan')
                    ->getStateUsing(fn ($record) => $record->user?->name ?? '-'),
                TextColumn::make('category')->label('Kategori'),
                TextColumn::make('highest_impression')->label('Highest'),
                TextColumn::make('lowest_impression')->label('Lowest'),
                TextColumn::make('average_impression')->label('Average'),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label('Perusahaan')
                    ->options(fn () => User::whereHas('roles', fn ($query) => $query->where('name', 'company'))
                        ->pluck('name', 'id')),
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
            DailyImpressionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdminTraffic::route('/'),
            'create' => Pages\CreateAdminTraffic::route('/create'),
            'edit' => Pages\EditAdminTraffic::route('/{record}/edit'),
        ];
    }
}
