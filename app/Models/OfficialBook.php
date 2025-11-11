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

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'isbn',
        'edisi',
        'sipnosis_cerita',
        'link_ke_web_buku',
        'gambar_cover',
    ];
}
