<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\CommunityStoryStatus;
use App\Models\User;
use App\Models\ReadingHistory;
use Illuminate\Support\Facades\Storage;

class CommunityStory extends Model
{
    protected $fillable = [ 
        'user_id',
        'judul',
        'penulis',
        'genre',
        'sipnosis',
        'gambar_cerita',
        'isi_cerita',
        'upload_file',
        'braille_file',
        'braille_mirrored_image',
        'status',
    ];

    protected static function booted(): void
    {
        static::deleting(function (CommunityStory $story) {
            if ($story->gambar_cerita) {
                Storage::disk('public')->delete($story->gambar_cerita);
            }
            if ($story->upload_file) {
                Storage::disk('public')->delete($story->upload_file);
            }
            if ($story->braille_file) {
                Storage::disk('public')->delete($story->braille_file);
            }
            if ($story->braille_mirrored_image) {
                Storage::disk('public')->delete($story->braille_mirrored_image);
            }
        });
    }
    public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function history()
        {
            // Relasi polimorfik
            return $this->morphMany(ReadingHistory::class, 'readable');
        }

    protected $casts = [
        'status' => CommunityStoryStatus::class,
    ];
}
