<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityStoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/', function () {
    return view('/');
})->middleware(['auth', 'verified'])->name('home');

// Route::get('/', function () {
//     return view('index');
// })->name('home');
// // ->middleware(['auth', 'verified'])

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/admin/dashboard', function () {
        // Cek jika role-nya BUKAN admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        // Tampilkan view dashboard admin
        return view('admin.dashboard');

    })->name('admin.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/karya/tulis', [CommunityStoryController::class, 'create'])->name('karya.create');
    Route::post('/karya/submit', [CommunityStoryController::class, 'store'])->name('karya.store');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('index');
});

Route::get('/terjemahkan', function () {
    return view('terjemahkan');
})->name('terjemahkan');

Route::get('/bukukomunitas', function () {
    return view('bukukomunitas');
});

Route::get('/bukukomunitas/detail', function () {
    return view('komunitasdetail');
});

Route::get('/bukukomunitas/detail/baca', function () {
    return view('komunitasbaca');
});

Route::get('/bukuresmi', function () {
    return view('bukuresmi');
});

Route::get('/bukuresmi/detail', function () {
    return view('bukuresmidetail');
});

Route::get('/audiobook', function () {
    return view('audiobook');
});

Route::get('/audiobook/detail', function () {
    return view('audiobookdetail');
});

Route::get('/audiobook/detail/dengar', function () {
    return view('audiobookdengar');
});

Route::get('/artikel', function () {
    return view('artikel');
});

Route::get('/artikel/baca', function () {
    return view('artikelbaca');
});


Route::get('/riwayatbaca', function () {
    return view('riwayatbaca');
});

Route::get('/riwayatunduh', function () {
    return view('riwayatunduh');
});

Route::get('/bagikankarya', function () {
    return view('bagikankarya');
});

Route::get('/bagikankarya/tuliskarya', function () {
    return view('tuliskarya');
});

Route::get('/bagikankarya/uploadkarya', function () {
    return view('uploadkarya');
});

Route::get('/karyasaya', function () {
    return view('karyasaya');
});