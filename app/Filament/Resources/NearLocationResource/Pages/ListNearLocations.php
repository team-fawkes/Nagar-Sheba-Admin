<?php

namespace App\Filament\Resources\NearLocationResource\Pages;

use App\Filament\Resources\NearLocationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNearLocations extends ListRecords
{
    protected static string $resource = NearLocationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
