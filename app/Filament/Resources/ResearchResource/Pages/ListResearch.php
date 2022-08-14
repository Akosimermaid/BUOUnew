<?php

namespace App\Filament\Resources\ResearchResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use ResearchResource\Widgets\StatsOverview;
use App\Filament\Resources\ResearchResource;


class ListResearch extends ListRecords
{
    protected static string $resource = ResearchResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
