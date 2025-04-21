<?php

namespace App\Filament\Resources\MediaStatisticResource\Pages;

use App\Filament\Resources\MediaStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaStatistics extends ListRecords
{
    protected static string $resource = MediaStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add Media Plan'),
        ];
    }
}
