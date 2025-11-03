<?php

namespace App\Filament\Resources\CommunityStories\Schemas;

// ↓↓↓ PASTIKAN 'use' INI LENGKAP ↓↓↓
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema; // Ini sudah benar (v4)

class CommunityStoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ↓↓↓ JAUH LEBIH BAIK daripada TextInput untuk user_id
                Select::make('user_id')
                    ->relationship('user', 'name') // 'user' = nama relasi di Model, 'name' = kolom yg ditampilkan
                    ->required()
                    ->searchable()
                    ->label('Penulis (Akun User)'),

                TextInput::make('judul')
                    ->required(),
                TextInput::make('penulis')
                    ->required()
                    ->label('Nama Pena (Nama Tampilan)'),
                TextInput::make('genre')
                    ->required(),
                Textarea::make('sipnosis')
                    ->required()
                    ->columnSpanFull(), // Lebar penuh

                // ↓↓↓ DIUBAH DARI TextInput
                FileUpload::make('gambar_cerita')
                    ->label('Gambar Cover Cerita')
                    ->image() // Validasi sbg gambar & beri preview
                    ->directory('story-covers') // Folder di 'storage/app/public'
                    ->imageEditor(),

                // ↓↓↓ DIUBAH DARI Textarea
                RichEditor::make('isi_cerita')
                    ->label('Isi Cerita (via Text Editor)')
                    ->columnSpanFull(),

                // ↓↓↓ DIUBAH DARI TextInput
                FileUpload::make('upload_file')
                    ->label('Upload File Cerita (.docx)')
                    ->directory('story-documents')
                    ->acceptedFileTypes([
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/msword', // Untuk .doc
                    ])
                    ->preserveFilenames(),

                // ↓↓↓ DIUBAH DARI TextInput
                FileUpload::make('braille_file')
                    ->label('Upload File Braille (.brf)')
                    ->directory('braille-files')
                    ->preserveFilenames(),

                // Ini sudah benar, saya tambahkan label & directory
                FileUpload::make('braille_mirrored_image')
                    ->label('Gambar Cermin Braille')
                    ->image()
                    ->directory('braille-images')
                    ->imageEditor(),
            ]);
    }
}
