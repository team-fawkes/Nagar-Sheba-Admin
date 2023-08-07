<?php

namespace App\Filament\Resources\BulletinResource\Pages;

use App\Filament\Resources\BulletinResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBulletins extends ListRecords
{
    protected static string $resource = BulletinResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
