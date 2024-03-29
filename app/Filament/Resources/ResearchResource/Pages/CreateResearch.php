<?php

namespace App\Filament\Resources\ResearchResource\Pages;

use App\Filament\Resources\ResearchResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateResearch extends CreateRecord
{
    protected static string $resource = ResearchResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
