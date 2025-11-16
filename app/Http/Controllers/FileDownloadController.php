<?php

namespace App\Http;
namespace App\Http\Controllers;

use App\Models\CommunityStory;
use App\Models\Audiobook;
use App\Models\DownloadHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

class FileDownloadController extends Controller
{
    /**
     * Menangani unduhan file, mencatatnya, lalu mengirimkan file.
     */
    public function downloadCommunityFile($id, $type)
    {
        $story = CommunityStory::findOrFail($id);
        $path = null;
        if ($type == 'brf' && $story->braille_file) {
            $path = $story->braille_file;
        } elseif ($type == 'zip' && $story->braille_mirrored_image) {
            $path = $story->braille_mirrored_image;
        } else {
            abort(404, 'File not found.');
        }

        if (Auth::check()) {
        // Cek apakah sudah ada log untuk file ini dalam 10 detik terakhir
        $recentDownload = DownloadHistory::where('user_id', Auth::id())
            ->where('downloadable_id', $story->id)
            ->where('downloadable_type', CommunityStory::class)
            ->where('file_type', $type)
            ->where('created_at', '>=', Carbon::now()->subSeconds(10))
            ->exists(); // 'exists()' sangat cepat

        // HANYA buat log baru jika TIDAK ADA log terbaru
        if (!$recentDownload) {
            DownloadHistory::create([
                'user_id' => Auth::id(),
                'downloadable_id' => $story->id,
                'downloadable_type' => CommunityStory::class,
                'file_type' => $type,
            ]);
        }
    }

    // 2. KIRIM FILE
    return Storage::disk('public')->download($path);

        return Storage::disk('public')->download($path);
    }
    public function downloadAudiobook($id)
    {
        $audiobook = Audiobook::findOrFail($id);
        $path = $audiobook->file_audio;
        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'File audio tidak ditemukan.');
        }

        if (Auth::check()) {
        // Cek apakah sudah ada log untuk file ini dalam 10 detik terakhir
        $recentDownload = DownloadHistory::where('user_id', Auth::id())
            ->where('downloadable_id', $audiobook->id)
            ->where('downloadable_type', Audiobook::class)
            ->where('created_at', '>=', Carbon::now()->subSeconds(10))
            ->exists();

        // HANYA buat log baru jika TIDAK ADA log terbaru
        if (!$recentDownload) {
            DownloadHistory::create([
                'user_id' => Auth::id(),
                'downloadable_id' => $audiobook->id,
                'downloadable_type' => Audiobook::class,
                'file_type' => pathinfo($path, PATHINFO_EXTENSION),
            ]);
        }
    }

    // 2. KIRIM FILE
    return Storage::disk('public')->download($path);
    }
}