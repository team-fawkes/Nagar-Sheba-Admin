<?php

namespace App\Filament\Resources\ComplainFileResource\Pages;

use App\Filament\Resources\ComplainFileResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComplainFile extends EditRecord
{
    protected static string $resource = ComplainFileResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
