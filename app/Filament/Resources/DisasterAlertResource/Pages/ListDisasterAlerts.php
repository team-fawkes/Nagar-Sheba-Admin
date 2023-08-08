<?php

namespace App\Filament\Resources\DisasterAlertResource\Pages;

use App\Filament\Resources\DisasterAlertResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDisasterAlerts extends ListRecords
{
    protected static string $resource = DisasterAlertResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
