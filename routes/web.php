<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Reservasi;

/* -----------------------------------
        PUBLIC / JAMAAH
   ----------------------------------- */

// Home & Berita
Route::get('/', [BeritaController::class, 'home'])->name('home');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/kegiatan/semuaBerita', [BeritaController::class, 'portal'])->name('kegiatan.semuaBerita');

// Profile
Route::get('/profile/sejarah', fn() => view('profile.sejarah'))->name('profile.sejarah');
Route::get('/profile/struktur', fn() => view('profile.struktur'))->name('profile.struktur');

// Kegiatan
Route::get('/kegiatan/agenda', [BeritaController::class, 'agenda'])->name('kegiatan.agenda');
Route::get('/kegiatan/kajian', [BeritaController::class, 'kajian'])->name('kegiatan.kajian');
Route::get('/kegiatan/pendidikan', [BeritaController::class, 'pendidikan'])->name('kegiatan.pendidikan');
Route::get('/kegiatan/detail/{id}', [BeritaController::class, 'show'])->name('kegiatan.detail');
Route::get('/kegiatan/agenda/{id}', [BeritaController::class, 'agendaShow'])->name('agenda.show');
Route::get('/kegiatan/pendidikan/{id}', [BeritaController::class, 'pendidikanShow'])->name('pendidikan.show');

// ZIS & Keuangan Publik
Route::get('/infaq/pencatatan', fn() => view('infaq.pencatatan'))->name('infaq.pencatatan');
Route::get('/infaq/edZakat', fn() => view('infaq.edZakat'))->name('infaq.edZakat');
Route::get('/infaq/edInfaq', fn() => view('infaq.edInfaq'))->name('infaq.edInfaq');
Route::get('/api/laporan-keuangan', [KeuanganController::class, 'laporan'])->name('public.keuangan.laporan');

Route::post('/admin/zis/{id}/acc', [KeuanganController::class, 'accZis'])->name('zis.acc');
Route::post('/admin/zis/{id}/tolak', [KeuanganController::class, 'tolakZis'])->name('zis.tolak');

// Reservasi (Publik)
Route::get('/reservasi/wedding', fn() => view('reservasi.wedding'))->name('reservasi.wedding');
Route::get('/reservasi/socialevent', fn() => view('reservasi.socialevent'))->name('reservasi.socialevent');
Route::get('/reservasi/tgl-sesi', [ReservasiController::class, 'tanggalSesi'])->name('reservasi.tgl');
Route::get('/reservasi/selesai-lunas/{id}', [ReservasiController::class, 'selesaiLunas'])->name('reservasi.selesai.lunas');
Route::get('/reservasi/pelunasan/{id}', [ReservasiController::class, 'pelunasan'])->name('reservasi.pelunasan');

// Midtrans Webhook (tanpa auth & CSRF)
Route::post('/midtrans/notification', [MidtransController::class, 'handleNotification'])->name('midtrans.notification');

/* -----------------------------------
        AUTH & PASSWORD
   ----------------------------------- */

Route::get('/login', fn() => view('login'))->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot & Reset Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Google OAuth
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Verifikasi Email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/* -----------------------------------
        BUTUH LOGIN (Jamaah)
   ----------------------------------- */

Route::middleware(['auth', 'verified'])->group(function () {

    // Reservasi
    Route::post('/reservasi/ajukan-tanggal', [ReservasiController::class, 'ajukanTanggal'])->name('reservasi.ajukanTanggal');
    Route::get('/reservasi/formulir', [ReservasiController::class, 'formReservasi'])->name('reservasi.formulir');
    Route::post('/reservasi/submit', [ReservasiController::class, 'submit'])->name('reservasi.submit');
    Route::get('/reservasi/pembayaran/{id}', [ReservasiController::class, 'pembayaran'])->name('reservasi.pembayaran');
    Route::get('/reservasi/selesai/{id}', [ReservasiController::class, 'selesai'])->name('reservasi.selesai');
    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('riwayat.index');

    // SNAP TOKEN UNTUK DP (Memanggil fungsi snapToken)
    Route::post('/reservasi/snap-token/{id}', [ReservasiController::class, 'snapToken'])->name('reservasi.snap-token');

    // SNAP TOKEN UNTUK PELUNASAN (Memanggil fungsi snapTokenLunas)
    Route::post('/reservasi/snap-token-lunas/{id}', [ReservasiController::class, 'snapTokenLunas'])->name('reservasi.snap-token-lunas');
    Route::post('/reservasi/konfirmasi-wa/{id}', [ReservasiController::class, 'konfirmasiWa'])->name('reservasi.konfirmasi-wa');

    Route::get('/reservasi/check-status/{id}', [ReservasiController::class, 'checkStatus'])->name('reservasi.check-status');
    Route::post('/reservasi/{id}/upload-dp', [ReservasiController::class, 'uploadBuktiDp'])->name('reservasi.uploadDp');

    Route::get('/infaq/zis', fn() => view('infaq.zis'))->name('infaq.zis');
    Route::post('/infaq/zis/store', [KeuanganController::class, 'storeZis'])->name('zis.store');
});

/* -----------------------------------
        ADMIN AREA
   ----------------------------------- */

Route::get('/admin/login', fn() => view('admin.admin_login'))->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        $antreanDp = Reservasi::whereNotIn('status_dp', ['disetujui', 'ditolak', 'lunas'])
            ->whereNotIn('status', [
                'Menunggu Konfirmasi Tanggal',
                'Tanggal Dikonfirmasi - Silakan Lanjut Isi Formulir',
                'Menunggu Pembayaran DP'
            ])
            ->latest()->take(5)->get();
        $beritaTerbaru = \App\Models\Berita::latest()->take(5)->get();
        $totalJamaah = \App\Models\User::where('role', 'jamaah')->count();
        $jamaahBaruBulanIni = \App\Models\User::where('role', 'jamaah')
            ->whereMonth('created_at', now()->month)->count();

        $totalInfaq = \App\Models\Transaksi::where('keterangan', 'LIKE', '%infaq%')
                                           ->sum('nominal');

        $totalZakat = \App\Models\Transaksi::where('keterangan', 'LIKE', '%zakat%')
                                           ->sum('nominal');

        return view('admin.dashboard', compact(
            'antreanDp', 'beritaTerbaru', 'totalJamaah', 'jamaahBaruBulanIni', 
            'totalInfaq', 'totalZakat'
        ));
    })->name('dashboard');

    // Berita
    Route::post('/berita/struktur', [BeritaController::class, 'updateStruktur'])->name('struktur.update');
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::post('/berita/update/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::post('/berita/delete', [BeritaController::class, 'destroy'])->name('berita.delete');

    // Keuangan & Pencatatan
    Route::get('/pencatatan', [KeuanganController::class, 'index'])->name('pencatatan');
    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan');
    Route::get('/keuangan/laporan', [KeuanganController::class, 'laporan'])->name('keuangan.laporan');
    
    Route::post('/keuangan/acc-tanggal/{id}', [KeuanganController::class, 'accTanggal'])->name('keuangan.accTanggal');
    Route::post('/keuangan/tolak-tanggal/{id}', [KeuanganController::class, 'tolakTanggal'])->name('keuangan.tolakTanggal');
    
    Route::post('/keuangan/acc-dp/{id}', [KeuanganController::class, 'accDp'])->name('keuangan.accDp');
    Route::post('/keuangan/tolak-dp/{id}', [KeuanganController::class, 'tolakDp'])->name('keuangan.tolakDp');
    Route::post('/keuangan/transaksi', [KeuanganController::class, 'tambah'])->name('keuangan.tambah');
    Route::post('/keuangan/kategori', [KeuanganController::class, 'tambahKategori'])->name('keuangan.tambahKategori');
    Route::delete('/keuangan/kategori/{id}', [KeuanganController::class, 'hapusKategori'])->name('keuangan.hapusKategori');
    Route::put('/keuangan/transaksi/{id}', [KeuanganController::class, 'updateTransaksi'])->name('keuangan.updateTransaksi');
    Route::delete('/keuangan/transaksi/{id}', [KeuanganController::class, 'hapusTransaksi'])->name('keuangan.hapusTransaksi');
});
