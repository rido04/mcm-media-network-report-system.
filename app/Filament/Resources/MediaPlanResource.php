<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\MediaPlan;
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
                    ->label('Client')
                    ->options(User::whereHas('roles', fn($q) => $q->where('name', 'company'))
                        ->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                TextInput::make('media')
                    ->label('Media')
                    ->required(),
                DatePicker::make('start-date')
                    ->label('Start Date')
                    ->required(),
                DatePicker::make('end-date')
                    ->label('End Date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('user.name')
                ->label('Client')
                ->sortable(),
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
                ->getStateUsing(function ($record) {
                    $endDate = Carbon::parse($record->end_date);
                    $now = Carbon::now();
                    return $now->diffInDays($endDate, false); // false untuk mendapatkan nilai negatif jika sudah lewat
                })
                ->searchable(),
            TextColumn::make('total_impression')
                ->label('Total Impression')
                ->sortable()
                ->getStateUsing(function ($record) {
                    return $record->daily_impressions->sum('impression');
                })
                ->searchable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListMediaPlans::route('/'),
            'create' => Pages\CreateMediaPlan::route('/create'),
            'edit' => Pages\EditMediaPlan::route('/{record}/edit'),
        ];
    }
}
