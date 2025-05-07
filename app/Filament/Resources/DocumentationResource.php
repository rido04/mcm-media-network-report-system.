<?php

namespace App\Filament\Resources;

use Closure;
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
use Filament\Notifications\Notification;
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
    protected static ?string $navigationLabel = 'Documentation';
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
                Select::make('type')
                    ->label('Documentation Type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                    ])
                    ->default('image')
                    ->required()
                    ->live(),
                FileUpload::make('image_path')
                    ->label('Image')
                    ->disk('public')
                    ->directory('image')
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'image')
                    ->image()
                    ->required(fn (Forms\Get $get): bool => $get('type') === 'image'),
                    TextInput::make('link_video')
                    ->label('Video Link')
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'video')
                    ->url()
                    ->regex('/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/(watch\?v=|embed\/|v\/|shorts\/|youtu\.be\/)?[a-zA-Z0-9_-]{11}.*$/')
                    ->required(fn (Forms\Get $get): bool => $get('type') === 'video')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            // Ekstrak Video ID from other youtube format e.g short
                            preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|embed|shorts)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $state, $matches);
                            if (isset($matches[1])) {
                                // Normalize to standar format
                                $set('link_video', "https://www.youtube.com/watch?v={$matches[1]}");
                            } else {
                                // If Url null, set error
                                $set('link_video', null);
                                // Error Notification
                                Notification::make()
                                    ->title('Invalid YouTube URL')
                                    ->body('Please provide a valid YouTube video or Shorts URL.')
                                    ->danger()
                                    ->send();
                            }
                        }
                    }),
                FileUpload::make('thumbnail_path')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->directory('image')
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'video')
                    ->image()
                    ->required(fn (Forms\Get $get): bool => $get('type') === 'video'),
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
                    ->label('Description'),
                TextColumn::make('link_video')
                    ->label('Link Video'),
                TextColumn::make('created_at')
                    ->label('Updated at')

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
