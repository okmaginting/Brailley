<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityStoryController;
use App\Http\Controllers\OfficialBookController;
use App\Http\Controllers\OfficialBookLinkController;
use App\Http\Controllers\AudiobookController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ReadingHistoryController;
use App\Http\Controllers\FileDownloadController;
use App\Http\Controllers\DownloadHistoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Needed for Auth::user() checks

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Routes accessible to everyone)
|--------------------------------------------------------------------------
| Includes main landing page, lists, and read/listen actions.
*/

// Home Page (The main entry point)
Route::get('/', function () {
    return view('index');
})->name('home'); // Named 'home' for standard Laravel use

// Utility Pages
Route::get('/terjemahkan', function () {
    return view('terjemahkan');
})->name('terjemahkan');

// --- List Pages ---
Route::get('/ceritakomunitas', [CommunityStoryController::class, 'index'])->name('karya.index');
Route::get('/bukuresmi', [OfficialBookController::class, 'index'])->name('bukuresmi.index');
Route::get('/audiobook', [AudiobookController::class, 'index'])->name('audiobook.index');
Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');

// --- Detail & Read Actions (Public Access) ---
Route::get('/ceritakomunitas/{id}', [CommunityStoryController::class, 'show'])->name('karya.show');
Route::get('/ceritakomunitas/{id}/baca', [CommunityStoryController::class, 'read'])->name('karya.read');
Route::get('/artikel/{id}', [ArticleController::class, 'show'])->name('artikel.show');
Route::get('/audiobook/{id}', [AudiobookController::class, 'show'])->name('audiobook.show');
Route::get('/audiobook/{id}/listen', [AudiobookController::class, 'listen'])->name('audiobook.listen');
Route::get('/bukuresmi/{id}', [OfficialBookController::class, 'show'])->name('bukuresmi.show');

// --- External Redirects & Downloads (Public Access) ---
// Note: History tracking logic is inside the controllers (Auth::check())
Route::get('/bukuresmi/{id}/visit', [OfficialBookLinkController::class, 'visit'])->name('bukuresmi.visit');
Route::get('/download/story/{id}/{type}', [FileDownloadController::class, 'downloadCommunityFile'])
    ->whereIn('type', ['brf', 'zip'])
    ->name('file.download');
Route::get('/download/audiobook/{id}', [FileDownloadController::class, 'downloadAudiobook'])->name('audiobook.download');


/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATED ROUTES (MEMBER AREA)
|--------------------------------------------------------------------------
| Routes that require a logged-in user.
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // --- Member-specific Pages ---
    Route::get('/bagikankarya', function () {
        return view('bagikankarya'); // Halaman pembuka untuk bagikan karya
    })->name('karya.start');
    
    Route::get('/riwayatbaca', [ReadingHistoryController::class, 'index'])->name('history.index');
    Route::get('/riwayatunduh', [DownloadHistoryController::class, 'index'])->name('history.download');
    
    // --- Karya Submit Flow ---
    Route::get('/karya/tulis', [CommunityStoryController::class, 'create'])->name('karya.create');
    Route::post('/karya/submit', [CommunityStoryController::class, 'store'])->name('karya.store');
    Route::get('/karyasaya', [CommunityStoryController::class, 'myWorks'])->name('karya.mine');
    Route::post('/karya/{story}/request-delete', [CommunityStoryController::class, 'requestDelete'])->name('karya.requestDelete');

    // --- Profile Management ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Admin Redirection Fallbacks ---
    // NOTE: Filament handles the /admin route. These are often used as redirects.
    Route::get('/admin/dashboard', function () {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }
        return redirect('/admin'); // Redirect to Filament's actual path
    })->name('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| 3. AUTHENTICATION (Breeze defaults)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';