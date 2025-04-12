<?php

namespace App\Filament\Resources\TrafficStatResource\Pages;

use App\Filament\Resources\TrafficStatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrafficStats extends ListRecords
{
    protected static string $resource = TrafficStatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
