<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\KategoriKeuangan;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    public function index()
    {
        // Mencari status yang sesuai dengan database 
        $antreanDp = Reservasi::whereIn('status_dp', ['menunggu', 'menunggu_konfirmasi'])
            ->with('user')
            ->latest()
            ->get();

        $riwayat = Transaksi::with(['kategori', 'reservasi'])
            ->orderBy('tanggal', 'desc') // desc = newest to oldest
            ->orderBy('id', 'desc')      // jika tanggal sama, ID terbesar (terbaru) di atas
            ->get();
        $kategoriPemasukan  = KategoriKeuangan::where('jenis', 'pemasukan')->get();
        $kategoriPengeluaran = KategoriKeuangan::where('jenis', 'pengeluaran')->get();
        $jumlahPendingDp    = $antreanDp->count();
        $semuaReservasi = \App\Models\Reservasi::with(['transaksis'])
        ->where('status_dp', '!=', 'ditolak')
        ->latest()
        ->get();
        
        return view('admin.pencatatan.index', compact('antreanDp', 'riwayat', 'kategoriPemasukan', 'kategoriPengeluaran', 'jumlahPendingDp', 'semuaReservasi'));
    }

    public function accDp($id)
    {
        $rsv = Reservasi::findOrFail($id);

        // 1. Logika untuk menentukan Nama Kategori Otomatis
        $paketLokal = strtolower($rsv->paket);
        $namaKategori = 'DP Social Event'; // Kategori Default (untuk workshop, wisuda, majelis)

        if (str_contains($paketLokal, 'wedding')) {
            $namaKategori = 'DP Wedding';
        } elseif (str_contains($paketLokal, 'akad')) {
            $namaKategori = 'DP Akad';
        }

        // 2. Cari kategori di database, kalau belum ada otomatis dibuatkan!
        $kategori = KategoriKeuangan::firstOrCreate(
            ['nama' => $namaKategori],  
            ['jenis' => 'pemasukan']
        );

        // 3. Ubah status DP dan status utama menjadi lunas
        $rsv->update([
            'status_dp' => 'lunas',
            'status'    => 'Sudah DP' 
        ]);

        // 4. Catat otomatis ke buku kas dengan kategori yang sudah dideteksi
        Transaksi::create([
            'reservasi_id' => $rsv->id,
            'kategori_id'  => $kategori->id,
            'sumber'       => 'sistem',
            'jenis'        => 'pemasukan',
            'nominal'      => $rsv->nominal_dp,
            'keterangan'   => $namaKategori . ': ' . $rsv->nama_pemohon . ' (#' . $rsv->id . ')',
            'tanggal'      => now(),
        ]);

        return back()->with('success', 'Berhasil ACC! Data otomatis masuk ke kategori: ' . $namaKategori);
    }

    public function tolakDp($id)
    {
        $rsv = Reservasi::findOrFail($id);

        // Ubah status DP dan status utama menjadi ditolak
        $rsv->update([
            'status_dp' => 'ditolak',
            'status'    => 'Ditolak Admin' 
        ]);

        return back()->with('success', 'Pembayaran DP atas nama ' . $rsv->nama_pemohon . ' berhasil ditolak.');
    }

    public function laporan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        if ($bulan && $tahun) {
            // Per bulan → jabarkan semua transaksi
            $pemasukan   = Transaksi::with('kategori')->where('jenis', 'pemasukan')
                ->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
            $pengeluaran = Transaksi::with('kategori')->where('jenis', 'pengeluaran')
                ->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
            $periode = Carbon::create($tahun, $bulan)->translatedFormat('F Y');
            $ringkasan = false;

        } else {
            // Semua periode → group by kategori, tampil total per kategori saja
            $pemasukan = Transaksi::with('kategori')->where('jenis', 'pemasukan')
                ->get()
                ->groupBy('kategori_id')
                ->map(fn($group) => [
                    'nama'    => $group->first()->kategori->nama ?? '-',
                    'nominal' => $group->sum('nominal'),
                ])->values();

            $pengeluaran = Transaksi::with('kategori')->where('jenis', 'pengeluaran')
                ->get()
                ->groupBy('kategori_id')
                ->map(fn($group) => [
                    'nama'    => $group->first()->kategori->nama ?? '-',
                    'nominal' => $group->sum('nominal'),
                ])->values();

            $periode  = 'Semua Periode';
            $ringkasan = true;
        }

        return response()->json([
            'periode'          => $periode,
            'ringkasan'        => $ringkasan,
            'pemasukan'        => $pemasukan,
            'pengeluaran'      => $pengeluaran,
            'totalPemasukan'   => $pemasukan instanceof \Illuminate\Support\Collection ? $pemasukan->sum('nominal') : $pemasukan->sum('nominal'),
            'totalPengeluaran' => $pengeluaran instanceof \Illuminate\Support\Collection ? $pengeluaran->sum('nominal') : $pengeluaran->sum('nominal'),
            'surplus'          => $pemasukan->sum('nominal') - $pengeluaran->sum('nominal'),
        ]);
    }

    public function tambahManual(Request $request)
    {
        // 1. Simpan data transaksi ke tabel transaksis
        $transaksi = Transaksi::create([
            'tanggal'      => $request->tanggal,
            'jenis'        => $request->jenis,
            'kategori_id'  => $request->kategori_id,
            'reservasi_id' => $request->reservasi_id, 
            'nominal'      => $request->nominal,
            'keterangan'   => $request->keterangan ?? 'Transaksi Manual',
            'sumber'       => 'manual',
        ]);

        $pesanTambahan = '';

        // 2. Logika Pelunasan / Cicilan
        if ($request->filled('reservasi_id')) {
            $rsv = Reservasi::with('transaksis')->find($request->reservasi_id);
            
            if ($rsv) {
                $totalDibayar = $rsv->transaksis->where('jenis', 'pemasukan')->sum('nominal');
                $grandTotal = $rsv->grand_total; 
                
                if ($totalDibayar >= $grandTotal) {
                    $rsv->update([
                        'status_dp' => 'lunas',
                        'status'    => 'Lunas' 
                    ]);
                    $pesanTambahan = ' (Pembayaran LUNAS sepenuhnya).';
                } else {
                    $sisa = $grandTotal - $totalDibayar;
                    $pesanTambahan = ' (Pembayaran masuk, sisa tagihan: Rp ' . number_format($sisa, 0, ',', '.') . ').';
                }
            }
        }

        return back()->with('success', 'Transaksi manual berhasil dicatat! ' . $pesanTambahan);
    }

    public function tambahKategori(Request $request)
    {
        KategoriKeuangan::create($request->all());
        return back()->with('success', 'Kategori berhasil ditambah.');
    }

    public function hapusKategori($id)
    {
        KategoriKeuangan::findOrFail($id)->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}