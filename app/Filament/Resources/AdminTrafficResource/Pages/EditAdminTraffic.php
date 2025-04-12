<?php

namespace App\Filament\Resources\AdminTrafficResource\Pages;

use App\Filament\Resources\AdminTrafficResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdminTraffic extends EditRecord
{
    protected static string $resource = AdminTrafficResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
