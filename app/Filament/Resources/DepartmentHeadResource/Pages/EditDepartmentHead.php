<?php

namespace App\Filament\Resources\DepartmentHeadResource\Pages;

use App\Filament\Resources\DepartmentHeadResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDepartmentHead extends EditRecord
{
    protected static string $resource = DepartmentHeadResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
