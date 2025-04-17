<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use Filament\Tables\Columns\ImageColumn;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->role('company'); //query client menjadi role company
    }
    public static function getPluralLabel(): ?string
    {
        return 'Client';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Client Name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->required(fn ($livewire) => $livewire instanceof CreateRecord)
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)),
                Textarea::make('company_address')
                    ->label('Address')
                    ->required(),
                TextInput::make('company_phone')
                    ->label('Phone')
                    ->required(),
                FileUpload::make('company_logo')
                    ->label('Company Logo')
                    ->disk('public')
                    ->directory('logos')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->nullable()
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) {
                        $filename = $file->hashName(); // Generate unique filename
                        $path = $file->storeAs('logos', $filename, 'public'); // Simpan dengan path lengkap
                        return 'logos/'.$filename; // Simpan full path ke database
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('name')
                ->label('Client Name')
                ->searchable(),
            TextColumn::make('email')
                ->searchable(),
            TextColumn::make('company_address')
                ->label('Address')
                ->searchable(),
            TextColumn::make('company_phone')
                ->label('Phone')
                ->searchable(),
            ImageColumn::make('company_logo')
                ->label('Company Logo')
                ->disk('public')
                ->size(50)
                ->circular()
        ])
            ->filters([
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
