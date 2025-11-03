<?php

namespace App\Filament\Resources\OfficialBooks\Pages;

use App\Filament\Resources\OfficialBooks\OfficialBookResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOfficialBook extends EditRecord
{
    protected static string $resource = OfficialBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
