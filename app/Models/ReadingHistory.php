<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ReadingHistory extends Model
{
    use HasFactory;
    
    protected $table = 'reading_history';
    // Izinkan 'updateOrCreate' untuk mengisi kolom ini
    protected $guarded = [];

    // Relasi polimorfik
    public function readable()
    {
        return $this->morphTo();
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // --- ACCESSOR AJAIB ---

    // 1. Untuk mendapatkan Judul (konsisten)
    public function getTitleAttribute()
    {
        return $this->readable->judul ?? 'Judul Tidak Ditemukan';
    }

    // 2. Untuk mendapatkan Gambar Cover (konsisten)
    public function getCoverImageUrlAttribute()
    {
        if (!$this->readable) {
            return 'https://placehold.co/300x400/9ca3af/F1EFEC?text=Error';
        }

        $path = null;
        if ($this->readable_type === 'App\Models\CommunityStory') {
            $path = $this->readable->gambar_cerita;
        } else {
            // Untuk OfficialBook & Audiobook
            $path = $this->readable->gambar_cover;
        }

        if ($path) {
            return Storage::url($path);
        }
        
        // Fallback jika tidak ada gambar
        return 'https://placehold.co/300x400/9ca3af/F1EFEC?text=Tanpa+Cover';
    }

    // 3. Untuk mendapatkan URL (konsisten)
    public function getReadUrlAttribute()
    {
        if (!$this->readable) {
            return '#';
        }

        if ($this->readable_type === 'App\Models\CommunityStory') {
            return route('karya.read', $this->readable->id);
        }
        if ($this->readable_type === 'App\Models\OfficialBook') {
            return $this->readable->link_ke_web_buku;
        }
        if ($this->readable_type === 'App\Models\Audiobook') {
            return '#'; // Ganti dengan route audio Anda nanti
        }
        return '#';
    }
}