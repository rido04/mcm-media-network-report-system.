<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User; // Tambahkan ini untuk memastikan model User dikenali
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $data;
    }

    protected function afterCreate(): void
    {
        $this->record->assignRole('company');// registrasi role otomatis
    }

    protected function getRedirectUrl(): string
    {
        // redirect setelah input users
        return $this->getResource()::getUrl('index');
    }
}
