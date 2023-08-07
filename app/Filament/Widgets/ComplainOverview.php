<?php

namespace App\Filament\Widgets;

use App\Models\Complain;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ComplainOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Pending', Complain::where('status','pending')->count())
                ->description('Total pending '.Complain::where('status','pending')->count())
                ->color('danger'),
            Card::make('Received', Complain::where('status','received')->count())
                ->description('Total received '.Complain::where('status','received')->count())
                ->color('warning'),
            Card::make('Progress', Complain::where('status','progress')->count())
                ->description('Total in progress '.Complain::where('status','progress')->count())
                ->color('primary'),
            Card::make('Solved', Complain::where('status','solved')->count())
                ->description('Total '.Complain::where('status','solved')->count().' problems solved')
                ->color('success'),
        ];
    }
}
