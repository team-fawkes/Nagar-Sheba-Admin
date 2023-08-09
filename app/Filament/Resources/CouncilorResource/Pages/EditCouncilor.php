<?php

namespace App\Filament\Resources\CouncilorResource\Pages;

use App\Filament\Resources\CouncilorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCouncilor extends EditRecord
{
    protected static string $resource = CouncilorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
