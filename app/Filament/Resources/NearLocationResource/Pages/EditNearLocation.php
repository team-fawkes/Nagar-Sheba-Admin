<?php

namespace App\Filament\Resources\NearLocationResource\Pages;

use App\Filament\Resources\NearLocationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNearLocation extends EditRecord
{
    protected static string $resource = NearLocationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
