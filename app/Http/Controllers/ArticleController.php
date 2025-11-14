<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Menampilkan halaman list artikel.
     */
    public function index(Request $request)
    {
        // 1. Mulai query
        $query = Article::query();

        // 2. Tambahkan logika pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // 3. Ambil data, urutkan dari terbaru, dan paginasi (10 per halaman)
        $articles = $query->latest()->paginate(10);

        // 4. Kirim data ke view (asumsi nama file: artikel.blade.php)
        return view('artikel', [
            'articles' => $articles
        ]);
    }

    public function show($id)
    {
        // Ambil artikel berdasarkan ID atau tampilkan 404
        $article = Article::findOrFail($id); 

        // Kirim data artikel ke view
        // (Asumsi nama file: artikelbaca.blade.php)
        return view('artikelbaca', [
            'article' => $article
        ]);
    }

    /**
     * Helper function untuk mempersingkat teks
     * (Kita akan gunakan ini di Blade)
     */
    public static function excerpt($text, $limit = 100)
    {
        return Str::limit(strip_tags($text), $limit, '...');
    }
}
