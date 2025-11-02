<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class ReadingHistory extends Model
{
    public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function readable()
        {
            // Relasi polimorfik
            return $this->morphTo();
        }
}
