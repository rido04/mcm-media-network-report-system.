<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TrafficStat;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Filament\Resources\TrafficStatResource\Pages;
use App\Filament\Resources\TrafficStatResource\RelationManagers;

class TrafficStatResource extends Resource
{
    protected static ?string $model = TrafficStat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Perusahaan')
                    ->options(
                        fn () => User::whereHas('roles', fn ($query) => $query->where('name', 'company'))
                            ->pluck('name', 'id')
                    )
                    ->required(),

                Select::make('type')
                    ->options([
                        'commuterline' => 'Commuterline',
                        'bus' => 'Bus',
                        'traffic' => 'Traffic Kendaraan',
                    ])
                    ->required(),

                DatePicker::make('date')
                    ->required(),

                TextInput::make('impression')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Perusahaan'),
                TextColumn::make('type')->label('Tipe'),
                TextColumn::make('date')->date()->label('Tanggal'),
                TextColumn::make('impression')->label('Impression'),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
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
            'index' => Pages\ListTrafficStats::route('/'),
            'create' => Pages\CreateTrafficStat::route('/create'),
            'edit' => Pages\EditTrafficStat::route('/{record}/edit'),
        ];
    }
}
