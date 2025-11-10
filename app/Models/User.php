<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\CommunityStory; 
use App\Models\ReadingHistory;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Mengecek apakah user boleh mengakses Panel Admin.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Pastikan ini menggunakan '===' (tiga sama dengan)
        // dan 'admin' (huruf kecil)
        return $this->role === 'admin';
    }


    /**
     * Mendapatkan semua community story yang ditulis oleh user ini.
     */
    public function communityStories()
    {
        return $this->hasMany(CommunityStory::class);
    }

    /**
     * Mendapatkan semua riwayat baca milik user ini.
     */
    public function readingHistory()
    {
        return $this->hasMany(ReadingHistory::class);
    }
    public function downloadHistory()
    {
        return $this->hasMany(DownloadHistory::class);
    }
    
}