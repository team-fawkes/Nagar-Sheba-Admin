<?php

namespace App\Filament\Resources\ComplainFileResource\Pages;

use App\Filament\Resources\ComplainFileResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComplainFiles extends ListRecords
{
    protected static string $resource = ComplainFileResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
