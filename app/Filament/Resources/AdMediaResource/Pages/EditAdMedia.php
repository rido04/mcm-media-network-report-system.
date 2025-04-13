<?php

namespace App\Filament\Resources\AdMediaResource\Pages;

use App\Filament\Resources\AdMediaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdMedia extends EditRecord
{
    protected static string $resource = AdMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
