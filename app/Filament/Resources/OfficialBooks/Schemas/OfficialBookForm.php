<?php

namespace App\Filament\Resources\OfficialBooks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload; // <-- 1. TAMBAHKAN 'use' INI
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
                TextInput::make('penerbit')
                    ->label('Penerbit')
                    ->nullable(),
                TextInput::make('isbn')
                    ->label('ISBN')
                    ->nullable(),
                TextInput::make('edisi')
                    ->label('Edisi')
                    ->nullable(),
                Textarea::make('sipnosis_cerita')
                    ->columnSpanFull(),
                TextInput::make('link_ke_web_buku')
                    ->required()
                    ->url()
                    ->label('Link ke Web Buku'),
                FileUpload::make('gambar_cover')
                    ->image()
                    ->disk('public')
                    ->directory('book-covers')

            ]);
    }
}