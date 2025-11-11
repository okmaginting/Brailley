<?php

namespace App\Http;
namespace App\Http\Controllers;

use App\Models\OfficialBook;
use Illuminate\Http\Request;

class OfficialBookController extends Controller
{
    /**
     * Menampilkan halaman list buku resmi.
     */
    public function index(Request $request)
    {
        // 1. Mulai query
        $query = OfficialBook::query();

        // 2. Tambahkan logika pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // 3. Ambil data, urutkan dari terbaru, dan paginasi (12 per halaman)
        $books = $query->latest()->paginate(12);

        // 4. Kirim data ke view
        return view('bukuresmi', [
            'books' => $books
        ]);
    }

    public function show($id)
    {
        // Ambil buku berdasarkan ID atau tampilkan 404
        $book = OfficialBook::findOrFail($id); 

        // Kirim data buku ke view
        return view('bukuresmidetail', [
            'book' => $book
        ]);
    }
}