<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['role_to_assign'] = 'company'; // optional, kalau mau pakai event
    return $data;
}

protected function afterCreate(): void
{
    $this->record->assignRole('company');
}

}
