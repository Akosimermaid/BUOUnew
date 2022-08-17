<?php

namespace App\Filament\Resources\ResearchResource\Widgets;


use App\Models\Research;
use Illuminate\Support\HtmlString;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            
            Card::make('Research Total', Research::all()->count()),
            Card::make('Recently Added', new HtmlString(implode("<br>", Research::latest()->take(5)->pluck('Title')->toArray()))),
           
        ];
    }
}
