<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Documentation;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class DocumentationWidget extends BaseWidget
{
    protected static ?string $heading = 'Documentation';
    protected static ?int $sort = 14;
    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
{
    return Documentation::query()->latest();
}
    public function table(Table $table): Table
    {
        return $table
            ->query(
                $this->getTableQuery()
            )
            ->columns([
                TextColumn::make('user.name')
                ->label('Perusahaan')
                ->searchable(),
                ImageColumn::make('image_path')
                ->label('Image'),
                TextColumn::make('description')
                ->label('Description')
            ]);
    }
}
