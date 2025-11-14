<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ReadingHistory;

class Audiobook extends Model
{
    public function history()
    {
        return $this->morphMany(ReadingHistory::class, 'readable');
    }
        
    protected $fillable = [
    'judul',
    'penulis',
    'pengisi_audio',
    'file_audio',
    'gambar_cover',
    ];
}
