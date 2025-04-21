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
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\AdMediaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions\DeleteAction as ActionsDeleteAction;
use App\Filament\Resources\AdMediaResource\RelationManagers;
use Filament\Tables\Filters\SelectFilter;

/*
Resource for managing ad media/media display
*/

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
                ->label('Client')
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
                            ->pluck('media', 'id') // ambil
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
            TextInput::make('title')
                ->label('Judul')
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
                TextColumn::make('user.name')
                    ->label('Client')
                    ->searchable(),
                TextColumn::make('mediaStatistic.media')
                    ->label('Media Plan')
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Title'),
                ImageColumn::make('image_path')
                    ->label('image'),
                TextColumn::make('start_date')
                    ->date(),
                TextColumn::make('end_date')
                    ->date(),
            ])->defaultSort('start_date', 'desc')
            ->filters([
                SelectFilter::make('user_id')
                    ->label('Client')
                    ->options(User::whereHas('roles', fn($q) => $q->where('name', 'company'))
                    ->pluck('name', 'id'))
                    ->label('Client')
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => Pages\ListAdMedia::route('/'),
            'create' => Pages\CreateAdMedia::route('/create'),
            'edit' => Pages\EditAdMedia::route('/{record}/edit'),
        ];
    }
}
