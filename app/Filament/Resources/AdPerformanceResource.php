<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AdminTraffic;
use App\Models\AdPerformance;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AdPerformanceResource\Pages;
use App\Filament\Resources\AdPerformanceResource\RelationManagers;

class AdPerformanceResource extends Resource
{
    protected static ?string $model = AdPerformance::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function getPluralLabel():string
    {
        return 'Storage';
    }

    protected static ?string $navigationGroup = 'Media';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                ->label('Client')
                ->options(fn () => User::whereHas('roles', fn($query) => $query->where('name', 'company'))
                ->pluck('name', 'id'))
                ->searchable()
                ->required()
                ->reactive()
                ,
                Select::make('admin_traffic_id')
                ->label('Category')
                ->options(function (callable $get) {
                    $userId = $get('user_id');

                    if (!$userId) {
                        return [];
                    }

                    return AdminTraffic::query()
                        ->where('user_id', $userId)
                        ->get()
                        ->pluck('category', 'id')
                        ->toArray();
                })
                ->searchable()
                ->required()
                ->live(),
            TextInput::make('used_placement')
                ->label('Used Placement')
                ->required(),
            TextInput::make('available_placement')
                ->label('Available Placement')
                ->numeric()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('adminTraffic.category')->label('Category'),
                TextColumn::make('adminTraffic.user.name')->label('Client'),
                TextColumn::make('used_placement')->label('Used Placement'),
                TextColumn::make('available_placement')->label('Available Placement'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListAdPerformances::route('/'),
            'create' => Pages\CreateAdPerformance::route('/create'),
            'edit' => Pages\EditAdPerformance::route('/{record}/edit'),
        ];
    }
}
