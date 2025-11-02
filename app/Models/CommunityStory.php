<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\ReadingHistory;

class CommunityStory extends Model
{
    public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function history()
        {
            // Relasi polimorfik
            return $this->morphMany(ReadingHistory::class, 'readable');
        }
}
