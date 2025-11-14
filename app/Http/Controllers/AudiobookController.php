<?php

namespace App\Http;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audiobook;
use App\Models\ReadingHistory;
use Illuminate\Support\Facades\Auth;

class AudiobookController extends Controller
{
    /**
     * Menampilkan halaman list audiobook.
     */
    public function index(Request $request)
    {
        $query = Audiobook::query();
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', '%' . $searchTerm . '%')
                  ->orWhere('penulis', 'like', '%' . $searchTerm . '%')
                  ->orWhere('pengisi_audio', 'like', '%' . $searchTerm . '%');
            });
        }
        $audiobooks = $query->latest()->paginate(12);
        return view('audiobook', [
            'audiobooks' => $audiobooks
        ]);
    }
    public function show($id)
    {
        // Ambil audiobook berdasarkan ID atau tampilkan 404
        $audiobook = Audiobook::findOrFail($id); 

        // Kirim data audiobook ke view
        return view('audiobookdetail', [
            'audiobook' => $audiobook
        ]);
    }

    /**
     * Menampilkan halaman pemutar audio & mencatat riwayat.
     * ↓↓↓ TAMBAHKAN METHOD BARU INI ↓↓↓
     */
    public function listen($id)
    {
        $audiobook = Audiobook::findOrFail($id);

        // Cek jika user login, catat ke riwayat
        if (Auth::check()) {
            ReadingHistory::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'readable_id' => $audiobook->id,
                    'readable_type' => Audiobook::class,
                ],
                [] // 'updated_at' akan diperbarui otomatis
            );
        }
        return view('audiobookdengar', [
            'audiobook' => $audiobook
        ]);
    }
}
