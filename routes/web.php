<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityStoryController;
use App\Http\Controllers\OfficialBookController;
use App\Http\Controllers\OfficialBookLinkController;
use App\Http\Controllers\AudiobookController;
use App\Http\Controllers\ReadingHistoryController;
use App\Http\Controllers\FileDownloadController;
use App\Http\Controllers\DownloadHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/', function () {
    return view('/');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/admin/dashboard', function () {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }
        return view('admin.dashboard');

    })->name('admin.dashboard');

    Route::get('/admin/login', function () {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }
        return view('admin.dashboard');

    })->name('admin.dashboard');

    Route::get('/admin/login', function () {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }
        return view('admin.dashboard');

    })->name('admin.dashboard');

    

    Route::get('/riwayatbaca', [ReadingHistoryController::class, 'index'])->name('history.index');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/karya/tulis', [CommunityStoryController::class, 'create'])->name('karya.create');
    Route::post('/karya/submit', [CommunityStoryController::class, 'store'])->name('karya.store');
    Route::get('/karyasaya', [CommunityStoryController::class, 'myWorks'])->name('karya.mine');
    Route::post('/karya/{story}/request-delete', [CommunityStoryController::class, 'requestDelete'])->name('karya.requestDelete');

    Route::get('/riwayatunduh', [DownloadHistoryController::class, 'index'])->name('history.download');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('index');
});

Route::get('/terjemahkan', function () {
    return view('terjemahkan');
})->name('terjemahkan');

Route::get('/ceritakomunitas', [CommunityStoryController::class, 'index'])->name('karya.index');
Route::get('/ceritakomunitas/{id}', [CommunityStoryController::class, 'show'])->name('karya.show');
Route::get('/ceritakomunitas/{id}/baca', [CommunityStoryController::class, 'read'])->name('karya.read');
Route::get('/download/story/{id}/{type}', [FileDownloadController::class, 'downloadCommunityFile'])
            ->whereIn('type', ['brf', 'zip'])
            ->name('file.download');

Route::get('/bukuresmi', [OfficialBookController::class, 'index'])->name('bukuresmi.index');
Route::get('/bukuresmi/{id}', [OfficialBookController::class, 'show'])->name('bukuresmi.show');
Route::get('/bukuresmi/{id}/visit', [OfficialBookLinkController::class, 'visit'])->name('bukuresmi.visit');

Route::get('/audiobook', [AudiobookController::class, 'index'])->name('audiobook.index');
Route::get('/audiobook/{id}', [AudiobookController::class, 'show'])->name('audiobook.show');
Route::get('/audiobook/{id}/listen', [AudiobookController::class, 'listen'])->name('audiobook.listen');
Route::get('/download/audiobook/{id}', [FileDownloadController::class, 'downloadAudiobook'])->name('audiobook.download');

Route::get('/artikel', function () {
    return view('artikel');
});

Route::get('/artikel/baca', function () {
    return view('artikelbaca');
});