<?php

namespace App\Filament\Resources\CommunityStories\Schemas;

use App\Enums\CommunityStoryStatus;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Group;

class CommunityStoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            
            // --- BAGIAN KIRI (Info Cerita) ---
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
                    
                    // ↓↓↓ PERBAIKAN DI SINI ↓↓↓
                    FileUpload::make('upload_file')
                        ->label('File Cerita (.docx)')
                        ->disk('public') // <--- WAJIB ADA: Agar Filament bisa menemukan filenya
                        ->directory('story-documents')
                        ->downloadable() // Agar bisa diunduh
                        ->openable() // Agar bisa dibuka di tab baru (opsional)
                        ->disabled() // Tetap disabled agar tidak bisa dihapus/diganti admin
                        ->dehydrated(false), // (Opsional) Agar tidak ikut tersimpan ulang saat save
                    // -------------------------

                    // Ini sudah benar (diedit sebelumnya)
                    RichEditor::make('isi_cerita')
                        ->label('Isi Cerita (Dapat Diedit)') 
                        ->columnSpanFull(),
                    
                    FileUpload::make('gambar_cerita')
                        ->label('Gambar Cover')
                        ->image()
                        ->disk('public') // Pastikan ini juga ada
                        ->directory('story-covers')
                        ->disabled(),
                ])->columnSpan(8),

            
            // --- BAGIAN KANAN (Aksi Admin) ---
            Group::make()
                ->schema([
                    Select::make('status')
                        ->options(CommunityStoryStatus::class)
                        ->required()
                        ->default(CommunityStoryStatus::Pengecekan)
                        ->live()
                        ->label('Status Cerita'),

                    FileUpload::make('braille_file')
                        ->label('Upload File Braille (.brf)')
                        ->disk('public')
                        ->directory('braille-files')
                        ->preserveFilenames(),

                    FileUpload::make('braille_mirrored_image')
                        ->label('Upload Mirrored Image (.zip)')
                        ->disk('public')
                        ->directory('braille-zip')
                        ->preserveFilenames(),      

                ])->columnSpan(4),

        ])->columns(12);
    }
}