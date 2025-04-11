<?php

namespace App\Filament\Resources\DailyImpressionResource\Pages;

use App\Filament\Resources\DailyImpressionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDailyImpression extends CreateRecord
{
    protected static string $resource = DailyImpressionResource::class;

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
