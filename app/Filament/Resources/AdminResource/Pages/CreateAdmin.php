<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;
    protected static ?string $title = 'Add Admin';
    protected function afterCreate(): void
    {
        $this->record->assignRole('admin');
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
