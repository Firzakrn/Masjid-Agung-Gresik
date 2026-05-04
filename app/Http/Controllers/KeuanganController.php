<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\KategoriKeuangan;
use App\Models\Reservasi;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    // ============================================================
    // INDEX — Halaman utama keuangan
    // ============================================================
    public function index()
    {
        $antreanDp = Reservasi::whereIn('status_dp', ['menunggu', 'lunas'])
            ->with('user')
            ->latest()
            ->get();

        $riwayat = Transaksi::with(['kategori', 'reservasi'])
            ->latest('tanggal')
            ->get();

        $kategoriPemasukan  = KategoriKeuangan::where('jenis', 'pemasukan')->get();
        $kategoriPengeluaran = KategoriKeuangan::where('jenis', 'pengeluaran')->get();
        $jumlahPendingDp    = $antreanDp->count();

        return view('admin.pencatatan', compact(
            'antreanDp',
            'riwayat',
            'kategoriPemasukan',
            'kategoriPengeluaran',
            'jumlahPendingDp'
        ));
    }

    // ============================================================
    // LAPORAN ARUS KAS
    // ============================================================
    public function laporan(Request $request)
    {
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);

        $pemasukan = Transaksi::where('jenis', 'pemasukan')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->with('kategori')
            ->get();

        $pengeluaran = Transaksi::where('jenis', 'pengeluaran')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->with('kategori')
            ->get();

        $totalPemasukan   = $pemasukan->sum('nominal');
        $totalPengeluaran = $pengeluaran->sum('nominal');
        $surplus          = $totalPemasukan - $totalPengeluaran;

        Carbon::setLocale('id');
        $namaBulan = Carbon::create()->month($bulan)->translatedFormat('F');

        $endOfMonth = Carbon::create($tahun, $bulan)->endOfMonth()->translatedFormat('j F Y');

        return response()->json([
            'pemasukan'        => $pemasukan,
            'pengeluaran'      => $pengeluaran,
            'totalPemasukan'   => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'surplus'          => $surplus,
            'periode'          => "1 $namaBulan $tahun - $endOfMonth",
        ]);
    }

    // ============================================================
    // ACC DP
    // ============================================================
    public function accDp($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        if ($reservasi->status_dp === 'disetujui') {
            return back()->with('error', 'DP ini sudah pernah disetujui.');
        }

        $kategori = KategoriKeuangan::firstOrCreate(
            ['nama' => 'Pemasukan DP Reservasi', 'jenis' => 'pemasukan']
        );

        Transaksi::create([
            'reservasi_id' => $reservasi->id,
            'kategori_id'  => $kategori->id,
            'sumber'       => 'reservasi',
            'jenis'        => 'pemasukan',
            'keterangan'   => "DP {$reservasi->paket} - {$reservasi->nama_pemohon}",
            'nominal'      => $this->hitungDp($reservasi->paket),
            'tanggal'      => now()->toDateString(),
            'bukti_bayar'  => $reservasi->bukti_dp,
        ]);

        $reservasi->update([
            'status_dp' => 'disetujui',
            'status'    => 'DP Disetujui',
        ]);

        return redirect()->route('admin.pencatatan')
            ->with('success', "DP #{$reservasi->id} berhasil di-ACC dan dicatat ke kas.");
    }

    // ============================================================
    // TOLAK DP
    // ============================================================
    public function tolakDp($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $reservasi->update([
            'status_dp' => 'ditolak',
            'status'    => 'DP Ditolak - Harap Upload Ulang',
        ]);

        return back()->with('info', "DP #{$reservasi->id} telah ditolak.");
    }

    // ============================================================
    // TAMBAH TRANSAKSI MANUAL
    // ============================================================
    public function tambahManual(Request $request)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'jenis'       => 'required|in:pemasukan,pengeluaran',
            'kategori_id' => 'required|exists:kategori_keuangans,id',
            'nominal'     => 'required|integer|min:1000',
            'keterangan'  => 'nullable|string|max:255',
        ]);

        $kategori = KategoriKeuangan::find($request->kategori_id);

        Transaksi::create([
            'reservasi_id' => null,
            'kategori_id'  => $request->kategori_id,
            'sumber'       => 'manual',
            'jenis'        => $request->jenis,
            'keterangan'   => $request->keterangan ?? $kategori->nama,
            'nominal'      => $request->nominal,
            'tanggal'      => $request->tanggal,
        ]);

        return back()->with('success', 'Transaksi manual berhasil dicatat.');
    }

    // ============================================================
    // TAMBAH KATEGORI
    // ============================================================
    public function tambahKategori(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:100',
            'jenis' => 'required|in:pemasukan,pengeluaran',
        ]);

        KategoriKeuangan::create($request->only('nama', 'jenis'));

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    // ============================================================
    // HAPUS KATEGORI
    // ============================================================
    public function hapusKategori($id)
    {
        $kategori = KategoriKeuangan::findOrFail($id);

        if ($kategori->transaksis()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh ' . $kategori->transaksis()->count() . ' transaksi.');
        }

        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    // ============================================================
    // HELPER — Hitung DP sesuai paket
    // ============================================================
    private function hitungDp(string $paket): int
    {
        if (stripos($paket, 'Intimate Wedding') !== false) return 1000000;
        if (stripos($paket, 'Wedding') !== false)         return 3000000;
        if (stripos($paket, 'Akad') !== false)            return 1000000;
        return 2000000;
    }
}