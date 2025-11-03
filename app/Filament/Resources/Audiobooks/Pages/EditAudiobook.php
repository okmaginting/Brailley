<?php

namespace App\Filament\Resources\Audiobooks\Pages;

use App\Filament\Resources\Audiobooks\AudiobookResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAudiobook extends EditRecord
{
    protected static string $resource = AudiobookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
