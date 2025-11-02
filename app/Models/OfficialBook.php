<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ReadingHistory;

class OfficialBook extends Model
{
    public function history()
        {
            // Relasi polimorfik
            return $this->morphMany(ReadingHistory::class, 'readable');
        }
}
