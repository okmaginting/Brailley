<?php

namespace App\Filament\Resources\OfficialBooks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OfficialBookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required(),
                TextInput::make('penulis')
                    ->required(),
                Textarea::make('sipnosis_cerita')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('link_ke_web_buku')
                    ->required(),
                TextInput::make('gambar_cover')
                    ->required(),
            ]);
    }
}
