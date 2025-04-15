<?php

namespace App\Filament\Resources\MediaPlanResource\Pages;

use App\Filament\Resources\MediaPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaPlan extends EditRecord
{
    protected static string $resource = MediaPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
