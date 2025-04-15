<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AdminTraffic;
use App\Models\MediaPlacement;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MediaPlacementResource\Pages;
use App\Filament\Resources\MediaPlacementResource\RelationManagers;

class MediaPlacementResource extends Resource
{
    protected static ?string $model = MediaPlacement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Table Log';
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
                Select::make('admin_traffic_id')
                ->label('Kategori')
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
                TextInput::make('media')
                ->label('Media')
                ->required(),
                TextINput::make('size')
                ->label('Size')
                ->required(),
                TextInput::make('space_ads')
                ->label('Space Ads')
                ->required(),
                TextInput::make('daily_impression_id')
                ->numeric()
                ->label('Impression')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                ->label('Perusahaan')
                ->sortable()
                ->searchable(),
                TextColumn::make('media')
                ->label('Media')
                ->sortable()
                ->searchable(),
                TextColumn::make('size')
                ->label('Size')
                ->sortable()
                ->searchable(),
                TextColumn::make('space_ads')
                ->label('Space Ads')
                ->sortable()
                ->searchable(),
                TextColumn::make('daily_impression_id')
                ->label('Daily Impression')
                ->sortable()
                ->searchable(),
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
            'index' => Pages\ListMediaPlacements::route('/'),
            'create' => Pages\CreateMediaPlacement::route('/create'),
            'edit' => Pages\EditMediaPlacement::route('/{record}/edit'),
        ];
    }
}
