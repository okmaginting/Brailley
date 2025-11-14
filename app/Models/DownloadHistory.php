<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Audiobook;

class DownloadHistory extends Model
{
    use HasFactory;
    protected $table = 'download_history'; // Gunakan nama singular
    protected $guarded = []; // Izinkan mass assignment

    // Relasi
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function downloadable() {
        return $this->morphTo();
    }

    // --- ACCESSOR (Agar Blade Bersih) ---

    public function getTitleAttribute() {
        return $this->downloadable->judul ?? 'Judul Tidak Ditemukan';
    }

    public function getSubtitleAttribute() {
        return $this->downloadable->penulis ?? 'Penulis Tidak Ditemukan';
    }

    public function getCoverImageUrlAttribute() {
        $path = $this->downloadable->gambar_cerita ?? $this->downloadable->gambar_cover;
        if ($path) {
            return Storage::url($path);
        }
        return 'https://placehold.co/300x400/9ca3af/F1EFEC?text=Tanpa+Cover';
    }

    // Link untuk melihat detail item
    public function getDetailUrlAttribute() {
        if ($this->downloadable_type === 'App\Models\CommunityStory') {
            return route('karya.show', $this->downloadable->id);
        }
        // Tambahkan if untuk model lain (OfficialBook, dll) nanti
        return '#';
    }

    // Link untuk mengunduh LAGI
    public function getDownloadUrlAttribute() {
        if ($this->downloadable_type === 'App\Models\CommunityStory') {
            return route('file.download', ['id' => $this->downloadable->id, 'type' => $this->file_type]);
        }
        return '#';
    }

    public function downloadAudiobook($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $audiobook = Audiobook::findOrFail($id);
        $path = $audiobook->file_audio;

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'File audio tidak ditemukan.');
        }

        // 1. CATAT UNDUHAN
        DownloadHistory::create([
            'user_id' => Auth::id(),
            'downloadable_id' => $audiobook->id,
            'downloadable_type' => Audiobook::class,
            'file_type' => pathinfo($path, PATHINFO_EXTENSION), // misal: 'mp3'
        ]);

        // 2. KIRIM FILE
        return Storage::disk('public')->download($path);
    }
}