<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AdminTraffic;
use App\Models\AdPerformance;
use App\Models\MediaStatistic;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AdPerformanceResource\Pages;
use App\Filament\Resources\AdPerformanceResource\RelationManagers;
use Filament\Tables\Filters\SelectFilter;

class AdPerformanceResource extends Resource
{
    protected static ?string $model = AdPerformance::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function getPluralLabel():string
    {
        return 'Availability Storage';
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
                    ->reactive(),
                Select::make('media_statistic_id')
                    ->label('City')
                    ->reactive()
                    ->options(function (callable $get) {
                        $userId = $get('user_id');
                        if (!$userId) {
                            return [];
                        }
                        return MediaStatistic::where('user_id', $userId)
                            ->select('id', 'city')
                            ->distinct()
                            ->pluck('city', 'id'); // key = value
                    })
                    ->required(),
                Select::make('admin_traffic_id')
                    ->label('Category')
                    ->reactive()
                    ->options(function (callable $get) {
                    $cityId = $get('media_statistic_id');

                    if (!$cityId) {
                        return [];
                    }

                    // Sesuaikan query ini dengan struktur database Anda
                    return AdminTraffic::whereHas('mediaStatistic', function ($query) use ($cityId) {
                        $query->where('id', $cityId);
                    })->pluck('Category', 'id');
                    }),
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
                TextColumn::make('mediaStatistic.city')
                    ->label('City/District')
                    ->searchable(),
                TextColumn::make('adminTraffic.category')
                    ->label('Category')
                    ->searchable(),
                TextColumn::make('adminTraffic.user.name')
                    ->label('Client')
                    ->searchable(),
                TextColumn::make('used_placement')
                    ->label('Used Placement'),
                TextColumn::make('available_placement')
                    ->label('Available Placement'),
            ])
            ->filters([
                SelectFilter::make('category')
                ->relationship('adminTraffic','category' )
                ->label('Category')
                
                
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
            'index' => Pages\ListAdPerformances::route('/'),
            'create' => Pages\CreateAdPerformance::route('/create'),
            'edit' => Pages\EditAdPerformance::route('/{record}/edit'),
        ];
    }
}
