<?php

namespace App\Filament\Resources\ResearchResource\Widgets;

use App\Models\Research;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Recently Added', 
            implode(',', Research::latest()->take(5)->pluck('Title')->toArray())),
           
        ];
    }
}
