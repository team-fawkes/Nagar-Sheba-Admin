<?php

namespace App\Filament\Resources\ComplainResource\Widgets;

use App\Models\Complain;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\Auth;

class ComplainOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $service_category_id = Auth::user()->service_category_id;
        $complain = Complain::all();
        if ($service_category_id) {
            $complain = Complain::where('service_category_id',Auth::user()->service_category_id)->get();
        }


        return [
            Card::make('Pending', $complain->where('status','pending')->count())
                ->description('Total pending '.Complain::where('status','pending')->count())
                ->color('danger'),
            Card::make('Received', $complain->where('status','received')->count())
                ->description('Total received '.Complain::where('status','received')->count())
                ->color('warning'),
            Card::make('Progress', $complain->where('status','progress')->count())
                ->description('Total in progress '.$complain->where('status','progress')->count())
                ->color('primary'),
            Card::make('Solved', $complain->where('status','solved')->count())
                ->description('Total '.$complain->where('status','solved')->count().' problems solved')
                ->color('success'),

        ];
    }
}
