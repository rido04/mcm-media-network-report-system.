<?php

namespace App\Filament\Resources\PlayLogResource\Pages;

use App\Filament\Resources\PlayLogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlayLog extends CreateRecord
{
    protected static string $resource = PlayLogResource::class;
    protected static ?string $title = 'Add Play Log';
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
