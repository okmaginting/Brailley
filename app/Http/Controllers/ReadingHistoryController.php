<?php

namespace App\Http;
namespace App\Http\Controllers;

use App\Models\CommunityStory;
use App\Models\OfficialBook;
use App\Models\Audiobook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReadingHistoryController extends Controller
{
    /**
     * Menampilkan halaman riwayat baca untuk user yang sedang login.
     */
    public function index(Request $request)
    {
        // 1. Mulai query dari riwayat milik user yang login
        $query = Auth::user()->readingHistory()
                    ->with('readable') // Eager load story/book/audiobook
                    ->latest('updated_at'); // Urutkan berdasarkan terakhir dibaca

        // 2. Logika Pencarian (Polimorfik)
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            
            // Ini akan mencari di kolom 'judul' di SEMUA tabel terkait
            $query->whereHasMorph(
                'readable',
                [CommunityStory::class, OfficialBook::class, Audiobook::class],
                function ($q) use ($searchTerm) {
                    $q->where('judul', 'like', '%' . $searchTerm . '%');
                }
            );
        }

        // 3. Ambil data dan paginasi (12 per halaman)
        $historyItems = $query->paginate(12);

        // 4. Kirim data ke view
        return view('riwayatbaca', [
            'historyItems' => $historyItems
        ]);
    }
}