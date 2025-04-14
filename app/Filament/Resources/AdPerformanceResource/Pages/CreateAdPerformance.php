<?php

namespace App\Filament\Resources\AdPerformanceResource\Pages;

use App\Filament\Resources\AdPerformanceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdPerformance extends CreateRecord
{
    protected static string $resource = AdPerformanceResource::class;
    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
}
