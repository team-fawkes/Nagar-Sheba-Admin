<?php

namespace App\Filament\Resources\SpectacularPlaceResource\Pages;

use App\Filament\Resources\SpectacularPlaceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpectacularPlace extends EditRecord
{
    protected static string $resource = SpectacularPlaceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
