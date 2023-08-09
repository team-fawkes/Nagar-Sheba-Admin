<?php

namespace App\Filament\Resources\WardResource\Pages;

use App\Filament\Resources\WardResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWard extends EditRecord
{
    protected static string $resource = WardResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
