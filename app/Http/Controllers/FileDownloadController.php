<?php

namespace App\Http;
namespace App\Http\Controllers;

use App\Models\CommunityStory;
use App\Models\Audiobook;
use App\Models\DownloadHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

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
            DownloadHistory::create([
                'user_id' => Auth::id(),
                'downloadable_id' => $story->id,
                'downloadable_type' => CommunityStory::class,
                'file_type' => $type,
            ]);
        }

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
            DownloadHistory::create([
                'user_id' => Auth::id(),
                'downloadable_id' => $audiobook->id,
                'downloadable_type' => Audiobook::class,
                'file_type' => pathinfo($path, PATHINFO_EXTENSION),
            ]);
        }

        return Storage::disk('public')->download($path);
    }
}