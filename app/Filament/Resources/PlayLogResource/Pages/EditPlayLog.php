<?php

namespace App\Filament\Resources\PlayLogResource\Pages;

use App\Filament\Resources\PlayLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlayLog extends EditRecord
{
    protected static string $resource = PlayLogResource::class;
    protected static ?string $title = 'Edit Play Log';
    protected function getRedirectUrl(): string
    {
        // redirect after input users
        return $this->getResource()::getUrl('index');
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
