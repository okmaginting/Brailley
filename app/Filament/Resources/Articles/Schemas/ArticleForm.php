<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required(),
                TextInput::make('penulis')
                    ->required(),
                Textarea::make('isi_artikel')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('gambar')
                    ->default(null),
            ]);
    }
}
