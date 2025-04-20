<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AdminTraffic;
use App\Models\MediaPlacement;
use App\Models\DailyImpression;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MediaPlacementResource\Pages;
use App\Filament\Resources\MediaPlacementResource\RelationManagers;

class MediaPlacementResource extends Resource
{
    protected static ?string $model = MediaPlacement::class;

    protected static ?string $navigationIcon = 'heroicon-o-tv';

    protected static ?string $navigationGroup = 'Table Log';
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
                TextInput::make('media')
                    ->label('Media')
                    ->required(),
                TextINput::make('size')
                    ->label('Size')
                    ->required(),
                TextInput::make('space_ads')
                    ->label('Space Ads')
                    ->required(),
                TextInput::make('avg_daily_impression')
                    ->label('Avg Daily Impression')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->step(0.01)
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Client')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('media')
                    ->label('Media')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('adminTraffic.category')
                    ->label('Category'),
                TextColumn::make('size')
                    ->label('Size')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('space_ads')
                    ->label('Space Ads')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('avg_daily_impression')
                    ->numeric(2)
                    ->label('Avg Impression')
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListMediaPlacements::route('/'),
            'create' => Pages\CreateMediaPlacement::route('/create'),
            'edit' => Pages\EditMediaPlacement::route('/{record}/edit'),
        ];
    }
}
