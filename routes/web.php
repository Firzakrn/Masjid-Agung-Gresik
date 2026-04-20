<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $news = collect([]); 
    return view('home', compact('news'));
})->name('home');

// --- Bagian Profile ----------------
    Route::get('/profile/sejarah', function () {
        return view('profile.sejarah'); 
    })->name('profile.sejarah');

    Route::get('/profile/struktur', function () {
        return view('profile.struktur');
    })->name('profile.struktur');
// ------------------------------------

// --- Bagian Kegiatan ----------------
    Route::get('/kegiatan/agenda', function () {
        return view('kegiatan.agenda');
    })->name('kegiatan.agenda');

    Route::get('/kegiatan/kajian', function () {
        return view('kegiatan.kajian');
    })->name('kegiatan.kajian');

    Route::get('/kegiatan/pendidikan', function () {
        return view('kegiatan.pendidikan');
    })->name('kegiatan.pendidikan');
// ------------------------------------

// --- Bagian Infaq ----------------
    Route::get('/infaq/pencatatan', function () {
        return view('infaq.pencatatan'); 
    })->name('infaq.pencatatan');
    Route::get('/infaq/infaq', function () {
        return view('infaq.infaq'); // Memanggil file resources/views/infaq/infaq.blade.php
    })->name('infaq.infaq');
// ------------------------------------

/* -----------------------------------
        LOGIN & REGISTER
    ----------------------------------- */

Route::get('/login', function () {
    return view('login'); 
})->name('login');

Route::post('/register', function () {
    return "Data pendaftaran berhasil dikirim!"; 
})->name('register');

/* -----------------
        ADMIN
   ----------------- */
Route::get('/admin/login', function () {
    return view('admin.admin_login');
})->name('admin.login');
// Rute untuk memproses form login Admin
Route::post('/admin/login', function () {
    return "Proses pengecekan username dan password admin...";
})->name('admin.login.submit');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); 
})->name('admin.dashboard');
Route::get('/admin/berita', function () {
    return view('admin.berita'); 
})->name('admin.berita');
Route::get('/admin/pencatatan', function () {
    return view('admin.pencatatan'); 
})->name('admin.pencatatan');