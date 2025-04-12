<?php

namespace App\Filament\Resources\TrafficStatResource\Pages;

use App\Filament\Resources\TrafficStatResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTrafficStat extends CreateRecord
{
    protected static string $resource = TrafficStatResource::class;

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
