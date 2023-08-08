<?php

namespace App\Filament\Resources\DisasterAlertResource\Pages;

use App\Filament\Resources\DisasterAlertResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDisasterAlert extends EditRecord
{
    protected static string $resource = DisasterAlertResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
