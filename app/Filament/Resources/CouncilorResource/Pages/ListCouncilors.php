<?php

namespace App\Filament\Resources\CouncilorResource\Pages;

use App\Filament\Resources\CouncilorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCouncilors extends ListRecords
{
    protected static string $resource = CouncilorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
