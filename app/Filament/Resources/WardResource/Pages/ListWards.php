<?php

namespace App\Filament\Resources\WardResource\Pages;

use App\Filament\Resources\WardResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWards extends ListRecords
{
    protected static string $resource = WardResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
