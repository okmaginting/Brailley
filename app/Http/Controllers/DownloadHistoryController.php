<?php

namespace App\Http;
namespace App\Http\Controllers;

use App\Models\CommunityStory; // (Perlu untuk pencarian)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownloadHistoryController extends Controller
{
    /**
     * Menampilkan halaman riwayat unduh untuk user yang sedang login.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->downloadHistory()
                    ->with('downloadable')
                    ->latest(); // Urutkan berdasarkan terbaru

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->whereHasMorph(
                'downloadable',
                [CommunityStory::class], // Tambahkan model lain di sini nanti
                fn ($q) => $q->where('judul', 'like', '%' . $searchTerm . '%')
            );
        }

        $historyItems = $query->paginate(9); // 9 item (3x3 grid)

        return view('riwayatunduh', [
            'historyItems' => $historyItems
        ]);
    }
}
