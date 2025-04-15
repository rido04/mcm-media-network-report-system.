<?php

namespace App\Filament\Resources\MediaPlacementResource\Pages;

use App\Filament\Resources\MediaPlacementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaPlacement extends EditRecord
{
    protected static string $resource = MediaPlacementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
