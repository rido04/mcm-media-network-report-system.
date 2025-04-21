<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\PlayLog;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\PlayLogResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PlayLogResource\RelationManagers;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

class PlayLogResource extends Resource
{
    protected static ?string $model = PlayLog::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
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
                TextInput::make('device_id')
                ->label('Device ID')
                ->required(),
                TextInput::make('media_name')
                ->label('Media Name')
                ->required(),
                DatePicker::make('play_date')
                ->label('Play Date')
                ->required(),
                TextInput::make('longitude')
                ->label('Longitude')
                ->numeric()
                ->required(),
                TextInput::make('latitude')
                ->label('Latitude')
                ->numeric()
                ->required(),
                TextInput::make('location')
                ->label('Location')
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                ->label('Client')
                ->searchable(),
                TextColumn::make('device_id')
                ->label('Device ID')
                ->searchable(),
                TextColumn::make('media_name')
                ->label('Media Name')
                ->searchable(),
                TextColumn::make('play_date')
                ->label('Play Date')
                ->searchable(),
                TextColumn::make('longitude')
                ->label('Longitude')
                ->searchable(),
                TextColumn::make('latitude')
                ->label('Latitude')
                ->searchable(),
                TextColumn::make('location')
                ->label('Location')
                ->searchable(),
            ])
            ->filters([
                // make form for filters  here
                Filter::make('client_and_location')
                    ->form([
                        Select::make('user_id')
                            ->label('Client')
                            ->options(fn () => User::whereHas('roles', fn ($query) => $query->where('name', 'company'))
                                        ->pluck('name', 'id'))
                            ->reactive(),

                        Select::make('location')
                            ->label('Location')
                            ->options(function (callable $get) {
                                $userId = $get('user_id');

                                if (!$userId) return [];

                                return PlayLog::where('user_id', $userId)
                                    ->select('location')
                                    ->distinct()
                                    ->pluck('location', 'location');
                            }),
                        Select::make('device_id')
                        ->label('Device ID')
                        ->options(function (callable $get) {
                            $userId = $get('user_id');
                            if (!$userId) return [];
            
                            return PlayLog::where('user_id', $userId)
                                ->select('device_id')
                                ->distinct()
                                ->pluck('device_id', 'device_id');
                        })
                        ->searchable(),
                
                        Select::make('media_name')
                            ->label('Media Name')
                            ->options(function (callable $get) {
                                $userId = $get('user_id');
                                if (!$userId) return [];
                
                                return PlayLog::where('user_id', $userId)
                                    ->select('media_name')
                                    ->distinct()
                                    ->pluck('media_name', 'media_name');
                            })
                            ->searchable(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data['user_id']) {
                            $query->where('user_id', $data['user_id']);
                        }
                
                        if ($data['location']) {
                            $query->where('location', $data['location']);
                        }
                
                        if ($data['device_id']) {
                            $query->where('device_id', $data['device_id']);
                        }
                
                        if ($data['media_name']) {
                            $query->where('media_name', $data['media_name']);
                        }
                
                        return $query;
                    }),


                
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
            'index' => Pages\ListPlayLogs::route('/'),
            'create' => Pages\CreatePlayLog::route('/create'),
            'edit' => Pages\EditPlayLog::route('/{record}/edit'),
        ];
    }
}
