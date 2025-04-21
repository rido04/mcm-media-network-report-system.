<?php

namespace App\Filament\Resources\PlayLogResource\Pages;

use App\Filament\Resources\PlayLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlayLogs extends ListRecords
{
    protected static string $resource = PlayLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add Play Log'),
        ];
    }
}
