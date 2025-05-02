<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Documentation;
use Filament\Resources\Resource;
use Filament\Tables\Grouping\Group;
use Filament\Forms\Components\Select;
use function Laravel\Prompts\textarea;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;

use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DocumentationResource\Pages;
use App\Filament\Resources\DocumentationResource\RelationManagers;

class DocumentationResource extends Resource
{
    protected static ?string $model = Documentation::class;
    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $navigationGroup = 'Table Log';
    protected static ?string $navigationLabel = 'Documnetation';
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
                Textarea::make('description')
                    ->label('Description')
                    ->required(),
                FileUpload::make('image_path')
                    ->label('Masukan Gambar Dokumentasi')
                    ->image()
                    ->disk('public')
                    ->directory('image')
                    ->visibility('public')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateIcon('heroicon-o-camera')
            ->groups([
                Group::make('user.name')
                    ->label('Company')
            ])
            ->columns([
                TextColumn::make('user.name')
                    ->label('Client')
                    ->searchable(),
                ImageColumn::make('image_path')
                    ->label('Image'),
                TextColumn::make('description')
                    ->label('Description')

            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label('Client')
                    ->options(User::whereHas('roles', fn($q) => $q->where('name', 'company'))
                            ->pluck('name', 'id'))
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
            'index' => Pages\ListDocumentations::route('/'),
            'create' => Pages\CreateDocumentation::route('/create'),
            'edit' => Pages\EditDocumentation::route('/{record}/edit'),
        ];
    }
}
