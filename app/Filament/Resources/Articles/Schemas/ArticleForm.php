<?php

namespace App\Filament\Resources\Articles\Schemas;

// --- Impor Komponen Form (v4) ---
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('penulis')
                    ->required(),
                
                FileUpload::make('gambar')
                    ->label('Gambar Utama')
                    ->nullable() // Boleh kosong
                    ->image()
                    ->disk('public')
                    ->directory('article-images')
                    ->imageEditor(),
                
                RichEditor::make('isi_artikel')
                    ->label('Isi Artikel')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}