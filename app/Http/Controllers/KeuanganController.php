<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\KategoriKeuangan;
use App\Models\Reservasi;
use App\Models\Zis;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    public function index()
    {
        $antreanDp = Reservasi::whereNotIn('status_dp', ['disetujui', 'ditolak', 'lunas'])
        ->whereNotIn('status', [
            'Tanggal Dikonfirmasi - Silakan Lanjut Isi Formulir',
            'Menunggu Pembayaran DP'
        ])
        ->with('user') 
        ->latest()
        ->get();
    
        $riwayat = Transaksi::with(['kategori', 'reservasi'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    
        $kategoriPemasukan   = KategoriKeuangan::where('jenis', 'pemasukan')->get();
        $kategoriPengeluaran = KategoriKeuangan::where('jenis', 'pengeluaran')->get();
        $jumlahPendingDp     = $antreanDp->count();
    
        $semuaReservasi = Reservasi::with(['user', 'transaksis'])->latest()->get();
        $antreanZis = Zis::where('status', 'pending')->latest()->get();
    
        return view('admin.pencatatan.index', compact(
            'antreanDp', 'antreanZis', 'riwayat', 'kategoriPemasukan',
            'kategoriPengeluaran', 'jumlahPendingDp', 'semuaReservasi'
        ));
    }

    // --------------------------------------------------------
    // Konfirmasi & Penolakan Ketersediaan Tanggal Reservasi
    // --------------------------------------------------------
    public function accTanggal($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        
        $reservasi->update([
            'status' => 'Tanggal Dikonfirmasi - Silakan Lanjut Isi Formulir'
        ]);

        return back()->with('success', 'Tanggal berhasil dikonfirmasi available!');
    }

    public function tolakTanggal($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        
        $reservasi->update([
            'status' => 'Tanggal Ditolak', 
        ]);

        return back()->with('success', 'Tanggal ditolak. Jadwal di kalender kembali kosong.');
    }
    
    public function accDp($id)
    {
        $rsv = Reservasi::findOrFail($id);
        $paketLokal = strtolower($rsv->paket);

        $isLunas = $rsv->status_dp === 'dp_lunas_pending';

        if ($isLunas) {
        $namaKategori = 'Pelunasan Reservasi';
        
        $grandTotal = $rsv->grand_total;
        if (!$grandTotal || $grandTotal == 0) {
            $pkt = strtolower($rsv->paket);
            if (str_contains($pkt, 'intimate wedding')) $grandTotal = 2500000;
            elseif (str_contains($pkt, 'wedding')) $grandTotal = 12500000;
            elseif (str_contains($pkt, 'akad')) $grandTotal = 3000000;
            else $grandTotal = 7500000;
        }
        
        $nominal = $grandTotal - $rsv->nominal_dp;
        $rsv->update([
        'status_dp' => 'lunas',
        'status'    => 'Lunas',
     ]); 
        }  else {
            $namaKategori = 'DP Reservasi';
            $nominal      = $rsv->nominal_dp;

            $rsv->update([
                'status_dp' => 'disetujui',
                'status'    => 'DP Disetujui',
            ]);
        }

        $kategori = KategoriKeuangan::firstOrCreate(
            ['nama' => $namaKategori],
            ['jenis' => 'pemasukan']
        );

        Transaksi::create([
            'reservasi_id' => $rsv->id,
            'kategori_id'  => $kategori->id,
            'sumber'       => 'sistem',
            'jenis'        => 'pemasukan',
            'nominal'      => $nominal,
            'keterangan'   => $namaKategori . ': ' . $rsv->nama_pemohon . ' (#' . $rsv->id . ')',
            'tanggal'      => now(),
        ]);

        $pesan = $isLunas ? 'Pelunasan berhasil di-ACC! Reservasi statusnya LUNAS.' : 'Berhasil ACC DP! Data masuk ke kas kategori: ' . $namaKategori;
        return back()->with('success', $pesan);
    }
    public function tolakDp($id)
    {
        $rsv = Reservasi::findOrFail($id);

        $rsv->update([
            'status_dp' => 'ditolak',
            'status'    => 'DP Ditolak',
        ]);

        return back()->with('success', 'Pembayaran DP atas nama ' . $rsv->nama_pemohon . ' berhasil ditolak.');
    }

    // === FUNGSI LAPORAN ===
    public function laporan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        if ($bulan && $tahun) {
            $pemasukan = Transaksi::with('kategori')->where('jenis', 'pemasukan')
                ->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get()
                ->groupBy('kategori_id')
                ->map(fn($group) => (object)[
                    'kategori' => $group->first()->kategori,
                    'nominal'  => $group->sum('nominal'),
                ])->values();

            $pengeluaran = Transaksi::with('kategori')->where('jenis', 'pengeluaran')
                ->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get()
                ->groupBy('kategori_id')
                ->map(fn($group) => (object)[
                    'kategori' => $group->first()->kategori,
                    'nominal'  => $group->sum('nominal'),
                ])->values();

            $periode   = Carbon::create($tahun, $bulan)->translatedFormat('F Y');
            $ringkasan = false;

        } else {
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

            $periode   = 'Semua Periode';
            $ringkasan = true;
        }

        return response()->json([
            'periode'          => $periode,
            'ringkasan'        => $ringkasan,
            'pemasukan'        => $pemasukan,
            'pengeluaran'      => $pengeluaran,
            'totalPemasukan'   => $pemasukan->sum('nominal'),
            'totalPengeluaran' => $pengeluaran->sum('nominal'),
            'surplus'          => $pemasukan->sum('nominal') - $pengeluaran->sum('nominal'),
        ]);
    }

    // === FUNGSI TAMBAH TRANSAKSI MANUAL ===
    public function tambah(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis'   => 'required|in:pemasukan,pengeluaran',
            'nominal' => 'required|numeric|min:1', 
        ], [
            'nominal.required' => 'Nominal uang tidak boleh kosong!',
            'nominal.numeric'  => 'Nominal harus berupa angka.'
        ]);
        
        $buktiBayar = null;
        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $nama_file = time() . '_' . $file->hashName();
            $file->move($_SERVER['DOCUMENT_ROOT'] . '/bukti_transaksi', $nama_file);
            $buktiBayar = 'bukti_transaksi/' . $nama_file;
        }

        if ($request->jenis === 'pengeluaran') {
            $keterangan = '';
            if ($request->pihak_penerima)         $keterangan .= 'Penerima: ' . $request->pihak_penerima;
            if ($request->bentuk_pengeluaran)     $keterangan .= ($keterangan ? ' | ' : '') . 'Via: ' . $request->bentuk_pengeluaran;
            if ($request->keterangan_pengeluaran) $keterangan .= ($keterangan ? ' | ' : '') . $request->keterangan_pengeluaran;
        } else {
            $keterangan = $request->keterangan_pemasukan ?? $request->keterangan ?? '';
            if ($request->nama_penyetor) $keterangan .= ($keterangan ? ' | ' : '') . 'Penyetor: ' . $request->nama_penyetor;
            if ($request->uang)          $keterangan .= ($keterangan ? ' | ' : '') . 'Via: ' . $request->uang;
        }

        Transaksi::create([
            'tanggal'      => $request->tanggal,
            'jenis'        => $request->jenis,
            'kategori_id'  => $request->kategori_id,
            'reservasi_id' => $request->reservasi_id ?: null,
            'nominal'      => $request->nominal,
            'keterangan'   => $keterangan ?: 'Transaksi Manual',
            'sumber'       => 'manual',
            'bukti_bayar'  => $buktiBayar,
        ]);

        $pesanTambahan = '';

        if ($request->filled('reservasi_id')) {
            $rsv = Reservasi::with('transaksis')->find($request->reservasi_id);

            if ($rsv) {
                $totalDibayar = $rsv->transaksis->where('jenis', 'pemasukan')->sum('nominal');
                $grandTotal   = $rsv->grand_total;

                if ($totalDibayar >= $grandTotal) {
                    $rsv->update([
                        'status_dp' => 'lunas',
                        'status'    => 'Lunas',
                    ]);
                    $pesanTambahan = ' (Pembayaran LUNAS sepenuhnya).';
                } else {
                    $sisa = $grandTotal - $totalDibayar;
                    $pesanTambahan = ' (Pembayaran masuk, sisa tagihan: Rp ' . number_format($sisa, 0, ',', '.') . ').';
                }
            }
        }

        return back()->with('success', 'Transaksi manual berhasil dicatat!' . $pesanTambahan);
    }

    // === FUNGSI KATEGORI ===
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

    // === FUNGSI UPDATE & HAPUS TRANSAKSI ===
    public function updateTransaksi(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'nominal'     => $request->nominal,
            'keterangan'  => $request->keterangan,
            'kategori_id' => $request->kategori_id,
            'tanggal'     => $request->tanggal,
        ]);

        return response()->json(['success' => true, 'message' => 'Transaksi berhasil diperbarui.']);
    }

    public function hapusTransaksi($id)
    {
        Transaksi::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
    
    public function storeZis(Request $request)
        {
            $request->validate([
                'nama_pemberi'   => 'required|string|max:255',
                'jenis_dana'     => 'required|string',
                'jumlah_dana'    => 'required|numeric|min:10000',
                'jumlah_orang'   => 'nullable|integer|min:1',
                'keterangan'     => 'nullable|string',
                'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            $bukti = null;
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $nama_file = time() . '_' . $file->hashName();
                $file->move($_SERVER['DOCUMENT_ROOT'] . '/bukti_zis', $nama_file);
                $bukti = 'bukti_zis/' . $nama_file;
            }

            Zis::create([
                'user_id'        => auth()->id(),
                'nama_pemberi'   => $request->nama_pemberi,
                'jenis_dana'     => $request->jenis_dana,
                'jumlah_orang'   => $request->jumlah_orang ?? 1,
                'jumlah_dana'    => $request->jumlah_dana,
                'keterangan'     => $request->keterangan,
                'bukti_transfer' => $bukti,
                'status'         => 'pending',
            ]);

            return back()->with('success', 'Jazakallah khairan! Pembayaran ZIS Anda sedang menunggu verifikasi admin.');
        }

    public function accZis($id)
    {
        $zis = Zis::findOrFail($id);

        $jenisDana  = $zis->jenis_dana;
        $jenisDanaLower = strtolower($jenisDana);

        $keterangan = $jenisDana
                    . ' | ' . $zis->jumlah_orang . ' orang'
                    . ' | Atas nama: ' . $zis->nama_pemberi;
        if ($zis->keterangan) {
            $keterangan .= ' | ' . $zis->keterangan;
        }

        if (str_contains($jenisDanaLower, 'fitrah')) {
            $namaKategori = 'Zakat Fitrah Online';
        } elseif (str_contains($jenisDanaLower, 'maal')) {
            $namaKategori = 'Zakat Maal Online';
        } elseif (str_contains($jenisDanaLower, 'fakir')) {
            $namaKategori = 'Infaq Fakir Miskin Online';
        } elseif (str_contains($jenisDanaLower, 'masjid')) {
            $namaKategori = 'Infaq Masjid Online';
        } elseif (str_contains($jenisDanaLower, 'yatim')) {
            $namaKategori = 'Infaq Anak Yatim Online';
        } elseif (str_contains($jenisDanaLower, 'infaq')) {
            $namaKategori = 'Infaq Online'; 
        } elseif (str_contains($jenisDanaLower, 'sedekah')) {
            $namaKategori = 'Sedekah Online';
        } else {
            $namaKategori = 'ZIS Online'; 
        }

        $kategori = KategoriKeuangan::firstOrCreate(
            ['nama' => $namaKategori],
            ['jenis' => 'pemasukan']
        );

        Transaksi::create([
            'tanggal'     => now(),
            'jenis'       => 'pemasukan',
            'kategori_id' => $kategori->id,
            'nominal'     => $zis->jumlah_dana,
            'keterangan'  => $keterangan,
            'sumber'      => 'zis_online',
            'bukti_bayar' => $zis->bukti_transfer,
        ]);

        $zis->update(['status' => 'disetujui']);

        return back()->with('success', 'ZIS atas nama ' . $zis->nama_pemberi . ' berhasil disetujui dan masuk ke kas kategori: ' . $namaKategori);
    }

    // Admin tolak
    public function tolakZis($id)
    {
        $zis = Zis::findOrFail($id);
        $zis->update(['status' => 'ditolak']);

        return back()->with('success', 'ZIS atas nama ' . $zis->nama_pemberi . ' telah ditolak.');
    }
}