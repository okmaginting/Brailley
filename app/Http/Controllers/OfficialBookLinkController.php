<?php

namespace App\Http;
namespace App\Http\Controllers;

use App\Models\OfficialBook;
use App\Models\ReadingHistory;
use Illuminate\Support\Facades\Auth;

class OfficialBookLinkController extends Controller
{
    /**
     * Catat klik & arahkan pengguna ke link eksternal.
     */
    public function visit($id)
    {
        $book = OfficialBook::findOrFail($id);

        // 1. Cek jika user login, catat ke riwayat
        if (Auth::check()) {
            ReadingHistory::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'readable_id' => $book->id,
                    'readable_type' => OfficialBook::class,
                ],
                [] // 'updated_at' akan diperbarui otomatis
            );
        }

        // 2. Arahkan pengguna ke link buku eksternal
        return redirect()->away($book->link_ke_web_buku);
    }
}