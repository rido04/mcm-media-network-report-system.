<?php

namespace App\Filament\Resources\AdMediaResource\Pages;

use App\Filament\Resources\AdMediaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdMedia extends EditRecord
{
    protected static string $resource = AdMediaResource::class;
    protected static ?string $title = 'Edit Media Display';
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
