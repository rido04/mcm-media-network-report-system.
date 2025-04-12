<?php

namespace App\Filament\Resources\TrafficStatResource\Pages;

use App\Filament\Resources\TrafficStatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrafficStat extends EditRecord
{
    protected static string $resource = TrafficStatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
