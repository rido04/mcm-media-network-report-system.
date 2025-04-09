<?php

namespace App\Filament\Company\Resources\MediaStatisticResource\Pages;

use App\Filament\Company\Resources\MediaStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMediaStatistic extends CreateRecord
{
    protected static string $resource = MediaStatisticResource::class;

    protected function getRedirectUrl(): string
    {
        // redirect setelah input users
        return $this->getResource()::getUrl('index');
    }
}
