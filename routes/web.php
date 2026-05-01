<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// --- Bagian Home & Berita ----------------
Route::get('/', [BeritaController::class, 'home'])->name('home');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/kegiatan/semuaBerita', [BeritaController::class, 'portal'])->name('kegiatan.semuaBerita');
// ------------------------------------

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

// --- Bagian Reservasi -------------
Route::get('/reservasi/wedding', function () {
    return view('reservasi.wedding'); 
})->name('reservasi.wedding');

Route::get('/reservasi/socialevent', function () {
    return view('reservasi.socialevent'); 
})->name('reservasi.socialevent');

    // Step 1 : tgl & sesi
    Route::get('/reservasi/tgl-sesi', [ReservasiController::class, 'tanggalSesi'])->name('reservasi.tgl');

    // Step 2 : formulir 
    Route::middleware(['auth'])->group(function () {
        Route::get('/reservasi/formulir', [ReservasiController::class, 'formReservasi'])->name('reservasi.formulir');
        Route::post('/reservasi/submit', [ReservasiController::class, 'submit'])->name('reservasi.submit');
    // Step 3 : pembayaran
        Route::get('/reservasi/pembayaran/{id}', [ReservasiController::class, 'pembayaran'])->name('reservasi.pembayaran');
        // Invoice akhir
        Route::post('/reservasi/selesai/{id}', [ReservasiController::class, 'selesai'])->name('reservasi.selesai');
        Route::get('/riwayat', [UserController::class, 'riwayat'])->name('riwayat.index');
});
// ------------------------------------

// --- Bagian ZIS  ----------------
Route::get('/infaq/pencatatan', function () {
    return view('infaq.pencatatan'); 
})->name('infaq.pencatatan');

Route::get('/infaq/zakat', function () {
    return view('infaq.zakat'); 
})->name('infaq.zakat');

Route::get('/infaq/infaq', function () {
    return view('infaq.infaq'); 
})->name('infaq.infaq');
// ------------------------------------


/* -----------------------------------
        LOGIN & REGISTER
   ----------------------------------- */
// Route Tampilan
Route::get('/login', function () {
    return view('login'); 
})->name('login');

// Route Proses Form
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login']); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- Rute Verifikasi Email -----------------
    // 1. Halaman pemberitahuan cek email
    Route::get('/email/verify', function () {
        return view('verify-email');
    })->middleware('auth')->name('verification.notice');

    // 2. Proses saat user klik link di email
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/')->with('welcome', 'Alhamdulillah, Email berhasil diverifikasi!');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    // 3. Tombol kirim ulang email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi baru telah dikirim!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/* -----------------
        ADMIN
   ----------------- */
Route::get('/admin/login', function () {
    return view('admin.admin_login');
})->name('admin.login');

// Rute untuk memproses form login Admin
Route::post('/admin/login', function () {
    return redirect()->route('admin.dashboard');
})->name('admin.login.submit');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); 
})->name('admin.dashboard');

// --- Berita ----------------------------------
Route::get('/admin/berita', [BeritaController::class, 'index'])->name('admin.berita');
Route::post('/admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
Route::post('/admin/berita/update/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
Route::post('/admin/berita/delete', [BeritaController::class, 'destroy'])->name('admin.berita.delete');
// ---------------------------------------------

Route::get('/admin/pencatatan', function () {
    return view('admin.pencatatan'); 
})->name('admin.pencatatan');