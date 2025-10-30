<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('login');
});

Route::get('/editprofile', function () {
    return view('editprofile');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/bagikankarya', function () {
    return view('bagikankarya');
});

Route::get('/bagikankarya/tuliskarya', function () {
    return view('tuliskarya');
});

Route::get('/bagikankarya/tuliskarya/tuliskaryanew', function () {
    return view('tuliskaryanew');
});

Route::get('/bagikankarya/uploadkarya', function () {
    return view('uploadkarya');
});


Route::get('/login/forgotpassword', function () {
    return view('forgotpassword');
});

Route::get('/login/forgotpassword/verifikasicode', function () {
    return view('verifikasicode');
});

Route::get('/login/forgotpassword/verifikasicode/confirmcode', function () {
    return view('confirmcode');
});

Route::get('/login/forgotpassword/verifikasicode/confirmcode/resetpassword', function () {
    return view('resetpassword');
});

Route::get('/login/forgotpassword/verifikasicode/confirmcode/resetpassword/berhasilpw', function () {
    return view('berhasilpw');
});