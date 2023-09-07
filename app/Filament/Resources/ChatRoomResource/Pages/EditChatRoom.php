<?php

namespace App\Filament\Resources\ChatRoomResource\Pages;

use App\Filament\Resources\ChatRoomResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChatRoom extends EditRecord
{
    protected static string $resource = ChatRoomResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
