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
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MediaStatisticResource\Pages;
use App\Filament\Resources\MediaStatisticResource\RelationManagers;
use Filament\Tables\Actions\DeleteAction;

class MediaStatisticResource extends Resource
{
    protected static ?string $model = MediaStatistic::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function getPluralLabel(): ?string
    {
        return 'Media Statistik';
    }

    protected static ?string $navigationGroup = 'Media';

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

            DatePicker::make('start_date')
                ->label('Tanggal Mulai')
                ->required(),

            DatePicker::make('end_date')
                ->label('Tanggal Selesai')
                ->required(),

            Select::make('media_plan')
                ->label('Media Plan')
                ->options([
                    'Commuterline' => 'Commuterline',
                    'Bus' => 'Bus',
                    'Sosial Media' => 'Sosial Media',
                ])
                ->required(),

            TextInput::make('city')
                ->label('Kota/Distrik')
                ->required(),

            TextInput::make('media_placement')
                ->label('Media Placement')
                ->maxLength(10)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Perusahaan'),
                TextColumn::make('media_plan')->label('Media Plan'),
                TextColumn::make('media_placement')->label('Media Placement'),
                TextColumn::make('city')->label('Kota/Distrik'),
                TextColumn::make('start_date')->label('Mulai')->date(),
                TextColumn::make('end_date')->label('Selesai')->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
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
            'index' => Pages\ListMediaStatistics::route('/'),
            'create' => Pages\CreateMediaStatistic::route('/create'),
            'edit' => Pages\EditMediaStatistic::route('/{record}/edit'),
        ];
    }
}
