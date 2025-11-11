<?php

namespace App\Http;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audiobook;

class AudiobookController extends Controller
{
    /**
     * Menampilkan halaman list audiobook.
     */
    public function index(Request $request)
    {
        // 1. Mulai query
        $query = Audiobook::query();

        // 2. Tambahkan logika pencarian (berdasarkan judul, penulis, atau pengisi audio)
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', '%' . $searchTerm . '%')
                  ->orWhere('penulis', 'like', '%' . $searchTerm . '%')
                  ->orWhere('pengisi_audio', 'like', '%' . $searchTerm . '%');
            });
        }

        // 3. Ambil data, urutkan dari terbaru, dan paginasi (12 per halaman)
        $audiobooks = $query->latest()->paginate(12);

        // 4. Kirim data ke view (asumsi nama file: audiobook.blade.php)
        return view('audiobook', [
            'audiobooks' => $audiobooks
        ]);
    }
}
