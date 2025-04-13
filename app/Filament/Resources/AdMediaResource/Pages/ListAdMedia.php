<?php

namespace App\Filament\Resources\AdMediaResource\Pages;

use App\Filament\Resources\AdMediaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdMedia extends ListRecords
{
    protected static string $resource = AdMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
