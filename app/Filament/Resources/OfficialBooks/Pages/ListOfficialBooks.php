<?php

namespace App\Filament\Resources\OfficialBooks\Pages;

use App\Filament\Resources\OfficialBooks\OfficialBookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOfficialBooks extends ListRecords
{
    protected static string $resource = OfficialBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
