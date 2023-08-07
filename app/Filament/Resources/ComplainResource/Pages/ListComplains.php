<?php

namespace App\Filament\Resources\ComplainResource\Pages;

use App\Filament\Resources\ComplainResource;
use App\Filament\Resources\ComplainResource\Widgets\ComplainOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComplains extends ListRecords
{
    protected static string $resource = ComplainResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            ComplainOverview::class
        ];
    }

}
