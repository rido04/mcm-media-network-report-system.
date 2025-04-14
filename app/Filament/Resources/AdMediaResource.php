<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\AdMedia;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MediaStatistic;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AdMediaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AdMediaResource\RelationManagers;
use Filament\Actions\DeleteAction as ActionsDeleteAction;

class AdMediaResource extends Resource
{
    protected static ?string $model = AdMedia::class;

    protected static ?string $navigationIcon = 'heroicon-o-play-pause';

    public static function getEloquentQuery():Builder
    {
        return parent::getEloquentQuery()
            ->with(['user', 'mediaStatistic']); // Eager loading
    }

    public static function  getPluralLabel(): string
    {
        return 'Media Display';
    }

    public static function getNavigationLabel(): string
    {
        return 'Media Display';
    }
    protected static ?string $navigationGroup = 'Media';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Select::make('user_id')
                ->label('Company')
                ->options(User::whereHas('roles', fn($q) => $q->where('name', 'company'))
                    ->pluck('name', 'id'))
                ->searchable()
                ->required(),

            Select::make('media_statistic_id')
                ->label('Media Plan')
                ->options(function (callable $get) {
                    $userId = $get('user_id');

                    return $userId
                        ? MediaStatistic::where('user_id', $userId)
                            ->pluck('media_plan', 'id') // Ambil ID dan nama media_plan
                        : [];
                })
                ->searchable()
                ->required()
                ->reactive(),

            FileUpload::make('image_path')
                ->image()
                ->disk('public')
                ->directory('image')
                ->visibility('public')
                ->required(),

            Textarea::make('description')
                ->rows(4)
                ->maxLength(1000),

            DatePicker::make('start_date')
                ->label('Tanggal Mulai')
                ->required(),

            DatePicker::make('end_date')
                ->label('Tanggal Selesai')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('user.name')->label('Company'),
            TextColumn::make('mediaStatistic.media_plan')->label('Media Plan'),
            ImageColumn::make('image_path')->circular(),
            TextColumn::make('start_date')->date(),
            TextColumn::make('end_date')->date(),
            ])->defaultSort('start_date', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
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
            'index' => Pages\ListAdMedia::route('/'),
            'create' => Pages\CreateAdMedia::route('/create'),
            'edit' => Pages\EditAdMedia::route('/{record}/edit'),
        ];
    }
}
