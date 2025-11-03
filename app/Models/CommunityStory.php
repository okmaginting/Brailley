<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\CommunityStoryStatus;
use App\Models\User;
use App\Models\ReadingHistory;

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
