<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AdminTraffic;
use Filament\Resources\Resource;
use function Laravel\Prompts\search;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AdminTrafficResource\Pages;
use App\Filament\Resources\AdminTrafficResource\RelationManagers;
use App\Filament\Resources\AdminTrafficResource\RelationManagers\DailyImpressionsRelationManager;

class AdminTrafficResource extends Resource
{
    protected static ?string $model = AdminTraffic::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function getPluralLabel():string
    {
        return 'Category';
    }
    protected static ?string $navigationGroup = 'Media';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Client')
                    ->options(fn () => User::whereHas('roles', fn($query) => $query->where('name', 'company'))
                        ->pluck('name', 'id')
                    )
                ->required(),
                TextInput::make('category')
                    ->label('Category')
                    ->required(),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Client')
                    ->searchable()
                    ->getStateUsing(fn ($record) => $record->user?->name ?? '-'),
                TextColumn::make('category')
                    ->label('Category')
                    ->searchable(),
                TextColumn::make('highest_impression')
                    ->label('Highest'),
                TextColumn::make('lowest_impression')
                    ->label('Lowest'),
                TextColumn::make('average_impression')
                    ->label('Average'),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label('Client')
                    ->options(fn () => User::whereHas('roles', fn ($query) => $query->where('name', 'company'))
                        ->pluck('name', 'id')),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
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
