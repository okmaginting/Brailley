<?php

namespace App\Filament\Resources\Audiobooks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AudiobookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required(),
                TextInput::make('penulis')
                    ->required(),
                TextInput::make('pengisi_audio')
                    ->required(),
                TextInput::make('file_audio')
                    ->required(),
                TextInput::make('gambar_cover')
                    ->default(null),
            ]);
    }
}
