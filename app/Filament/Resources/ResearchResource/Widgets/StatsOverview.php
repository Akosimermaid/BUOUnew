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
            Card::make('Research Total', Research::all()->count()),
            Card::make('Recently Added', 
                implode("\n", Research::latest()->take(5)->pluck('Title')->toArray())
               // Research::orderBy('created_at', 'desc')->first()->Title
            ),
           
        ];
    }
}
