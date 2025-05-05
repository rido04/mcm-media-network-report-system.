<?php

namespace App\Filament\Resources\MediaPlanResource\Pages;

use App\Filament\Resources\MediaPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaPlan extends EditRecord
{
    protected static string $resource = MediaPlanResource::class;
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
