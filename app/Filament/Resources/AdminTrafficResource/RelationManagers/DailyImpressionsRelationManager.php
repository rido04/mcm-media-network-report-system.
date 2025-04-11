<?php

namespace App\Filament\Resources\AdminTrafficResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;

class DailyImpressionsRelationManager extends RelationManager
{
    protected static string $relationship = 'dailyImpressions'; // Nama relasi di model AdminTraffic

    protected static ?string $recordTitleAttribute = 'date';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')
                    ->label('Tanggal')
                    ->required(),

                TextInput::make('impression')
                    ->label('Total Impression')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')->label('Tanggal')->date(),
                TextColumn::make('impression')->label('Total Impression'),
            ])
            ->defaultSort('date', 'desc');
    }
}
