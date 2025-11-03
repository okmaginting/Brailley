<?php

namespace App\Filament\Resources\Audiobooks\Pages;

use App\Filament\Resources\Audiobooks\AudiobookResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAudiobook extends CreateRecord
{
    protected static string $resource = AudiobookResource::class;
}
