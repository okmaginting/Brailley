<?php

namespace App\Filament\Resources\Audiobooks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class AudiobookForm
{
    /**
     * Ganti 'form' menjadi 'configure' agar cocok dengan v4
     */
    public static function configure(Schema $schema): Schema
    {
        /**
         * Ganti '$form->schema' menjadi '$schema->components'
         */
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                TextInput::make('penulis')
                    ->required()
                    ->maxLength(255),
                TextInput::make('pengisi_audio')
                    ->label('Narator / Pengisi Audio')
                    ->required()
                    ->maxLength(255),
                
                FileUpload::make('file_audio')
                    ->label('File Audio (MP3, dll)')
                    ->required()
                    ->disk('public') // Simpan di storage/app/public
                    ->directory('audio-files')
                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp3']) // Hanya MP3
                    ->preserveFilenames(),
                
                FileUpload::make('gambar_cover')
                    ->label('Gambar Cover')
                     ->nullable() // Boleh kosong
                    ->image() // Validasi sebagai gambar
                    ->disk('public')
                    ->directory('audiobook-covers')
                    ->imageEditor(),
            ]);
    }
}