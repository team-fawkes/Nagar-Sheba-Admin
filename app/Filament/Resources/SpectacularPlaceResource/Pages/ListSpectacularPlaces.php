<?php

namespace App\Filament\Resources\SpectacularPlaceResource\Pages;

use App\Filament\Resources\SpectacularPlaceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpectacularPlaces extends ListRecords
{
    protected static string $resource = SpectacularPlaceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
