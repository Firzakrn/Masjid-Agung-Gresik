<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\MidtransController;
use App\Models\Berita;

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
    // Ambil 3 agenda terbaru untuk Slider Hero (Highlight)
    $agendaHighlight = Berita::where('sub_kategori', 'agenda')->orderBy('created_at', 'desc')->take(3)->get();

    return view('Kegiatan.agenda', compact('agendaHighlight', 'agendaPosters'));
})->name('kegiatan.agenda');

Route::get('/kegiatan/kajian', function () {
    $kajianKitab = Berita::where('sub_kategori', 'kajian_kitab')
                        ->orderBy('created_at', 'desc')->get();

    $kajianRutin = Berita::where('sub_kategori', 'kajian_rutin')
                        ->orderBy('created_at', 'desc')->get();

    return view('kegiatan.kajian', compact('kajianKitab', 'kajianRutin'));
})->name('kegiatan.kajian');

Route::get('/kegiatan/pendidikan', function () {
    $pendidikanPosters = Berita::where('sub_kategori', 'pendidikan')
                               ->orderBy('created_at', 'desc')
                               ->get();
    return view('Kegiatan.pendidikan', compact('pendidikanPosters'));
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

    // middleware : kondisi, get : request data, post : kirim data
    Route::middleware(['auth'])->group(function () {
        Route::get('/reservasi/formulir', [ReservasiController::class, 'formReservasi'])->name('reservasi.formulir');
        Route::post('/reservasi/submit', [ReservasiController::class, 'submit'])->name('reservasi.submit');
    // Step 3 : pembayaran
        Route::get('/reservasi/pembayaran/{id}', [ReservasiController::class, 'pembayaran'])->name('reservasi.pembayaran');
        // Invoice akhir
        Route::get('/reservasi/selesai/{id}', [ReservasiController::class, 'selesai'])->name('reservasi.selesai');
        Route::get('/riwayat', [UserController::class, 'riwayat'])->name('riwayat.index');

        // ── BARU: Endpoint Midtrans ────────────────────────────────
        Route::post('/reservasi/snap-token/{id}', [ReservasiController::class, 'snapToken'])->name('reservasi.snap-token');
        Route::get('/reservasi/check-status/{id}', [ReservasiController::class, 'checkStatus'])->name('reservasi.check-status');
});
// ------------------------------------

// --- Bagian ZIS  ----------------
Route::get('/infaq/pencatatan', function () {
    return view('infaq.pencatatan'); 
})->name('infaq.pencatatan');
    Route::get('/api/laporan-keuangan', [App\Http\Controllers\KeuanganController::class, 'laporan'])->name('public.keuangan.laporan');

Route::get('/infaq/edZakat', function () {
    return view('infaq.edZakat'); 
})->name('infaq.edZakat');

Route::get('/infaq/edInfaq', function () {
    return view('infaq.edInfaq'); 
})->name('infaq.edInfaq');
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


/* -----------------
        ADMIN
   ----------------- */
Route::get('/admin/login', function () {
    return view('admin.admin_login');
})->name('admin.login');

Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

Route::get('/admin/dashboard', function () {
    $antreanDp = \App\Models\Reservasi::whereIn('status_dp', ['menunggu', 'menunggu_konfirmasi'])
                ->latest()
                ->take(5)
                ->get();
    
    $beritaTerbaru = \App\Models\Berita::latest()->take(5)->get();
    
    // Tambahan untuk widget di atas (total jamaah dll)
    $totalJamaah = \App\Models\User::where('role', 'jamaah')->count();
    $jamaahBaruBulanIni = \App\Models\User::where('role', 'jamaah')
                            ->whereMonth('created_at', now()->month)
                            ->count();

    return view('Admin.dashboard', compact('antreanDp', 'beritaTerbaru', 'totalJamaah', 'jamaahBaruBulanIni'));
})->name('admin.dashboard');

// --- Berita ----------------------------------
Route::get('/admin/berita', [BeritaController::class, 'index'])->name('admin.berita');
Route::post('/admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
Route::post('/admin/berita/update/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
Route::post('/admin/berita/delete', [BeritaController::class, 'destroy'])->name('admin.berita.delete');
// ---------------------------------------------

Route::get('/admin/pencatatan', [KeuanganController::class, 'index'])->name('admin.pencatatan');
Route::get('/admin/keuangan/laporan', [KeuanganController::class, 'laporan'])->name('admin.keuangan.laporan');

// Pastikan seperti ini, bukan route lain
Route::get('/kegiatan/kajian', [BeritaController::class, 'kajian']);
Route::get('/kegiatan/detail/{id}', [BeritaController::class, 'show'])->name('kegiatan.detail');
Route::get('/kegiatan/agenda', [BeritaController::class, 'agenda'])->name('agenda.index');
Route::get('/kegiatan/agenda/{id}', [BeritaController::class, 'agendaShow'])->name('agenda.show');
Route::get('/kegiatan/pendidikan', [BeritaController::class, 'pendidikan'])->name('pendidikan.index');
Route::get('/kegiatan/pendidikan/{id}', [BeritaController::class, 'pendidikanShow'])->name('pendidikan.show');

// ── Webhook Midtrans (TANPA auth, TANPA CSRF) ──────────────────
// Midtrans memanggil ini dari server mereka, bukan dari browser user
Route::post('/midtrans/notification', [MidtransController::class, 'handleNotification'])
    ->name('midtrans.notification');

// ============================================================
// ROUTE ADMIN KEUANGAN
// ============================================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Halaman utama keuangan
    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan');

    // Laporan arus kas 
    Route::get('/keuangan/laporan', [KeuanganController::class, 'laporan'])->name('keuangan.laporan');

    // ACC & Tolak DP
    Route::post('/keuangan/acc-dp/{id}', [KeuanganController::class, 'accDp'])->name('keuangan.accDp');
    Route::post('/keuangan/tolak-dp/{id}', [KeuanganController::class, 'tolakDp'])->name('keuangan.tolakDp');

    // Transaksi manual
    Route::post('/keuangan/transaksi', [KeuanganController::class, 'tambahManual'])->name('keuangan.tambah');

    // Kategori
    Route::post('/keuangan/kategori', [KeuanganController::class, 'tambahKategori'])->name('keuangan.tambahKategori');
    Route::delete('/keuangan/kategori/{id}', [KeuanganController::class, 'hapusKategori'])->name('keuangan.hapusKategori');
});

// ============================================================
// ROUTE JAMAAH — Upload Bukti DP
// ============================================================
Route::middleware(['auth'])->group(function () {
    Route::post('/reservasi/{id}/upload-dp', [ReservasiController::class, 'uploadBuktiDp'])->name('reservasi.uploadDp');
});
