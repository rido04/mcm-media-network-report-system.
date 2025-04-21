<?php

namespace App\Filament\Resources\MediaPlacementResource\Pages;

use App\Filament\Resources\MediaPlacementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaPlacements extends ListRecords
{
    protected static string $resource = MediaPlacementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add Media Placement'),
        ];
    }
}
