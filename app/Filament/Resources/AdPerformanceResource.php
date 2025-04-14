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

    protected static ?string $navigationIcon = 'heroicon-o-play-circle';

    protected static ?string $navigationGroup = 'Media';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                ->label('Perusahaan')
                ->options(fn () => User::whereHas('roles', fn($query) => $query->where('name', 'company'))
                ->pluck('name', 'id'))
                ->searchable()
                ->required()
                ->reactive()
                ,
                Select::make('admin_traffic_id')
                ->label('Kategori')
                ->options(function (callable $get) {
                    $userId = $get('user_id'); // Ambil nilai user_id yang dipilih
                    if (!$userId) {
                        return []; // Jika user_id belum dipilih, kembalikan array kosong
                    }
                    return AdminTraffic::where('user_id', $userId)
                        ->pluck('category', 'id'); // Ambil kategori berdasarkan user_id
                })
                ->searchable()
                ->required()
                ->reactive(),
            DatePicker::make('date')
                ->label('Tanggal')
                ->required(),
            TextInput::make('performance')
                ->label('Performance')
                ->numeric()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('adminTraffic.category')->label('Kategori'),
                TextColumn::make('adminTraffic.user.name')->label('Company'),
                TextColumn::make('date')->label('Tanggal')->date(),
                TextColumn::make('performance')->label('Performance'),
            ])->defaultSort('date', 'desc')
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
