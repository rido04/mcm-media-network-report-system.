<?php

namespace App\Filament\Resources\AdminTrafficResource\Pages;

use App\Filament\Resources\AdminTrafficResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdminTraffic extends CreateRecord
{
    protected static string $resource = AdminTrafficResource::class;
    protected static ?string $title = 'Add Category';

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
