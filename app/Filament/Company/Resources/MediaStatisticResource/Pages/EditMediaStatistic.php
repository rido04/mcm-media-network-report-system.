<?php

namespace App\Filament\Company\Resources\MediaStatisticResource\Pages;

use App\Filament\Company\Resources\MediaStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaStatistic extends EditRecord
{
    protected static string $resource = MediaStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
