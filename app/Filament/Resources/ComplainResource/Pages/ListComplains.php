<?php

namespace App\Filament\Resources\ComplainResource\Pages;

use App\Filament\Resources\ComplainResource;
use App\Filament\Resources\ComplainResource\Widgets\ComplainOverview;
use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListComplains extends ListRecords
{
    protected static string $resource = ComplainResource::class;


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
            $query->where('service_category_id', $service_category_id);
        }
        return $query;
    }
    protected function getHeaderWidgets(): array
    {
        return [
            ComplainOverview::class
        ];
    }


}
