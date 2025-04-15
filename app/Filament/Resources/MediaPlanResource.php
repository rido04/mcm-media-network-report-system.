<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\MediaPlan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MediaPlanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MediaPlanResource\RelationManagers;

class MediaPlanResource extends Resource
{
    protected static ?string $model = MediaPlan::class;

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
                TextInput::make('media')
                ->label('Media')
                ->searchable()
                ->required(),
                DatePicker::make('start-date')
                ->label('Start Date') 
                ->required(),
                DatePicker::make('end-date')
                ->label('End Date')
                ->required(),
                TextInput::make('remaining_days')
                ->numeric()
                ->label('Remaining Days')
                ->required(),   
                TextInput::make('total_impression')
                ->numeric()
                ->label('Total Impression')
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
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->sortable()
                    ->date(),
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->sortable()
                    ->date(),
                TextColumn::make('remaining_days')
                    ->label('Remaining Days')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total_impression')
                    ->label('Total Impression')
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
            'index' => Pages\ListMediaPlans::route('/'),
            'create' => Pages\CreateMediaPlan::route('/create'),
            'edit' => Pages\EditMediaPlan::route('/{record}/edit'),
        ];
    }
}
