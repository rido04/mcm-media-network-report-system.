<?php

namespace App\Filament\Resources\AdMediaResource\Pages;

use App\Filament\Resources\AdMediaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdMedia extends CreateRecord
{
    protected static string $resource = AdMediaResource::class;
    protected static ?string $title = 'Add Media Display';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
