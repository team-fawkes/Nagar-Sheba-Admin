<?php

namespace App\Filament\Resources\DepartmentHeadResource\Pages;

use App\Filament\Resources\DepartmentHeadResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDepartmentHeads extends ListRecords
{
    protected static string $resource = DepartmentHeadResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
