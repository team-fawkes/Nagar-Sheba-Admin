<?php

namespace App\Filament\Resources\ChatRoomResource\Pages;

use App\Filament\Resources\ChatRoomResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListChatRooms extends ListRecords
{
    protected static string $resource = ChatRoomResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();
        $service_category_id = Auth::user()->service_category_id;
        if ($service_category_id) {
            $query->whereHas('complain', function ($query) use ($service_category_id) {
                $query->whereHas('service_category', function ($subquery) use ($service_category_id) {
                    $subquery->where('id', $service_category_id);
                });
            });
        }
        return $query;
    }
}
