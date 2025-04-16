<?php

namespace App\Filament\Resources\PlayLogResource\Pages;

use App\Filament\Resources\PlayLogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlayLog extends CreateRecord
{
    protected static string $resource = PlayLogResource::class;
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
