<?php

namespace App\Filament\Resources\MediaPlacementResource\Pages;

use App\Filament\Resources\MediaPlacementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMediaPlacement extends CreateRecord
{
    protected static string $resource = MediaPlacementResource::class;

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
