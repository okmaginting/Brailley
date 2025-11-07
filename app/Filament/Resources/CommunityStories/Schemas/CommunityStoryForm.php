<?php

namespace App\Filament\Resources\CommunityStories\Schemas;

// (PASTIKAN SEMUA 'use' INI ADA)
use App\Enums\CommunityStoryStatus;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Group; // Ini adalah namespace v4 yang benar

class CommunityStoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            
            // --- BAGIAN KIRI (Info Cerita - READ ONLY) ---
            Group::make()
                ->schema([
                    TextInput::make('judul')->disabled(),
                    TextInput::make('penulis')->label('Nama Pena (Tampilan)')->disabled(),
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->label('Penulis (Akun User)')
                        ->disabled(),
                    TextInput::make('genre')->disabled(),
                    Textarea::make('sipnosis')->columnSpanFull()->disabled(),
                    
                    FileUpload::make('upload_file')
                        ->label('File Cerita (.docx) - (Hanya Unduh)')
                        ->directory('story-documents')
                        ->disabled()
                        ->downloadable(),

                    RichEditor::make('isi_cerita')
                        ->label('Isi Cerita (dari Text Editor)')
                        ->columnSpanFull()
                        ->disabled(),
                    
                    FileUpload::make('gambar_cerita')
                        ->label('Gambar Cover')
                        ->image()
                        ->directory('story-covers')
                        ->disabled(),
                ])->columnSpan(8),

            
            // --- BAGIAN KANAN (Aksi Admin - BISA DIEDIT) ---
            Group::make()
                ->schema([
                    // 1. DROPDOWN STATUS
                    Select::make('status')
                        ->options(CommunityStoryStatus::class)
                        ->required()
                        ->default(CommunityStoryStatus::Pengecekan)
                        ->live()
                        ->label('Status Cerita'),

                    // 2. UPLOAD FILE BRAILLE (.brf)
                    FileUpload::make('braille_file')
                        ->label('Upload File Braille (.brf)')
                        ->directory('braille-files')
                        ->preserveFilenames(),
                        // BARIS ->visible(...) SUDAH DIHAPUS DARI SINI

                    // 3. UPLOAD MIRRORED IMAGE (.ZIP)
                    FileUpload::make('braille_mirrored_image')
                        ->label('Upload Mirrored Image (.zip)')
                        ->directory('braille-zip')
                        ->preserveFilenames(),
                        // BARIS ->visible(...) SUDAH DIHAPUS DARI SINI

                ])->columnSpan(4),

        ])->columns(12);
    }
}