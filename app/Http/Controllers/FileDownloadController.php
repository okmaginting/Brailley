<?php

namespace App\Http;
namespace App\Http\Controllers;

use App\Models\CommunityStory;
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $story = CommunityStory::findOrFail($id);
        $path = null;

        if ($type == 'brf' && $story->braille_file) {
            $path = $story->braille_file;
        } elseif ($type == 'zip' && $story->braille_mirrored_image) {
            $path = $story->braille_mirrored_image;
        } else {
            abort(404, 'File not found.');
        }

        // 1. CATAT UNDUHAN
        DownloadHistory::create([
            'user_id' => Auth::id(),
            'downloadable_id' => $story->id,
            'downloadable_type' => CommunityStory::class,
            'file_type' => $type, // 'brf' atau 'zip'
        ]);

        // 2. KIRIM FILE
        return Storage::disk('public')->download($path);
    }
}