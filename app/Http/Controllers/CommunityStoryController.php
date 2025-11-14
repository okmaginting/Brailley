<?php

namespace App\Http;
namespace App\Http\Controllers;

use App\Models\CommunityStory;
use App\Enums\CommunityStoryStatus;
use App\Models\ReadingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CommunityStoryController extends Controller
{
    public function index(Request $request) // <-- 3. Tambahkan Request
    {
        $query = CommunityStory::where('status', CommunityStoryStatus::Dipublish);

        // 4. Tambahkan logika pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // 5. Ambil data, urutkan dari terbaru, dan paginasi (12 per halaman)
        $stories = $query->latest()->paginate(12);

        // 6. Kirim data ke view
        return view('ceritakomunitas', [
            'stories' => $stories
        ]);
    }

    public function show($id)
    {
        $story = CommunityStory::where('status', CommunityStoryStatus::Dipublish)
                                ->where('id', $id)
                                ->firstOrFail(); // Akan otomatis 404 jika tidak ditemukan

        // 4. Kirim data ke view
        return view('komunitasdetail', [
            'story' => $story
        ]);
    }

    public function read($id)
    {
        $story = CommunityStory::where('status', CommunityStoryStatus::Dipublish)
                                ->where('id', $id)
                                ->firstOrFail();

        $content = "";

        if (Auth::check()) {
            ReadingHistory::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'readable_id' => $story->id,
                    'readable_type' => CommunityStory::class,
                ],
                []
            );
        }

        // HANYA cek 'isi_cerita'
        if (!empty($story->isi_cerita)) {
            $content = $story->isi_cerita;
        } else {
            // Jika 'isi_cerita' kosong (misal: user upload .docx),
            // tampilkan pesan ini.
            $content = "Konten cerita ini tidak tersedia untuk dibaca secara online (hanya tersedia melalui file unduhan).";
        }

        return view('komunitasbaca', [
            'story' => $story,
            'content' => $content
        ]);
    }
    /**
     * Menampilkan halaman form untuk menulis karya.
     * (Asumsi nama file Blade Anda adalah 'tuliskarya.blade.php')
     */
    public function create()
    {
        return view('tuliskarya');
    }

    public function myWorks(Request $request)
    {
        // 1. Mulai query dari relasi user.
        // Ini secara otomatis hanya akan mengambil cerita milik user yang login.
        $query = Auth::user()->communityStories();

        // 2. Tambahkan logika pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // 3. Ambil data, urutkan dari terbaru, dan paginasi (12 per halaman)
        $stories = $query->latest()->paginate(12);

        // 4. Kirim data ke view 'karyasaya'
        return view('karyasaya', [
            'stories' => $stories
        ]);
    }

    /**
     * Menyimpan karya baru yang dikirim dari form.
     */
    public function store(Request $request)
    {
        // --- 1. VALIDASI DATA ---
        // Memastikan minimal salah satu (isi cerita atau upload file) terisi
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'sipnosis' => 'required|string',
            'gambar_cerita' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isi_cerita' => 'nullable|string|required_without:upload_file',
            'upload_file' => 'nullable|file|mimes:docx|required_without:isi_cerita',
        ]);

        // --- 2. PROSES FILE UPLOAD (JIKA ADA) ---
        $gambarPath = null;
        if ($request->hasFile('gambar_cerita')) {
            // Simpan di 'storage/app/public/story-covers'
            $gambarPath = $request->file('gambar_cerita')->store('story-covers', 'public');
        }

        $filePath = null;
        if ($request->hasFile('upload_file')) {
            // Simpan di 'storage/app/public/story-documents'
            $filePath = $request->file('upload_file')->store('story-documents', 'public');
        }

        // --- 3. SIMPAN KE DATABASE ---
        CommunityStory::create([
            'user_id' => Auth::id(), // Ambil ID user yang sedang login
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'genre' => $request->genre,
            'sipnosis' => $request->sipnosis,
            'isi_cerita' => $request->isi_cerita,
            'upload_file' => $filePath,
            'gambar_cerita' => $gambarPath,
            'status' => CommunityStoryStatus::Pengecekan, // Set status default
            
            // Kolom 'braille_file' dan 'braille_mirrored_image' 
            // akan 'null' secara default, dan akan diisi oleh admin nanti.
        ]);

        // --- 4. ALIHKAN PENGGUNA ---
        // Arahkan ke dashboard atau halaman 'karya saya' dengan pesan sukses
        return redirect('/bagikankarya')->with('success', 'Karya Anda berhasil dikirim dan sedang ditinjau!');
    }

    public function requestDelete(CommunityStory $story)
    {
        // 1. Pastikan user ini pemilik cerita
        if (Auth::id() !== $story->user_id) {
            abort(403, 'Anda tidak diizinkan melakukan aksi ini.');
        }

        // 2. Ubah statusnya
        $story->status = CommunityStoryStatus::RequestHapus;
        $story->save();

        // 3. Kembalikan ke halaman "Karya Saya"
        return redirect()->route('karya.mine')->with('success', 'Permintaan hapus telah dikirim dan akan ditinjau oleh Admin.');
    }

    
}