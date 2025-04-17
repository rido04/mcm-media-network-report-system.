<?php

namespace App\Filament\Resources\MediaStatisticResource\Pages;

use App\Filament\Resources\MediaStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMediaStatistic extends CreateRecord
{
    protected static string $resource = MediaStatisticResource::class;
    protected static ?string $title = 'Add Media Plan';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
