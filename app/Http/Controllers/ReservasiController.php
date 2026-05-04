<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class ReservasiController extends Controller
{
    public function tanggalSesi(Request $request)
    {
        $paket = $request->query('paket', 'Paket Belum Dipilih');
        return view('reservasi.konfirmasi.tgl-sesi', compact('paket'));
    }

    public function formReservasi(Request $request)
    {
        $paket   = $request->query('paket', 'Paket Belum Dipilih');
        $tanggal = $request->query('tanggal', '-');
        $sesi    = $request->query('sesi', '-');
        $harga   = 12500000;
        $dp      = 3000000;
        return view('reservasi.konfirmasi.formulir', compact('paket', 'tanggal', 'sesi', 'harga', 'dp'));
    }

    // --------------------------------------------------------
    // Halaman pembayaran + fasilitas (hitung harga, tampilkan)
    // --------------------------------------------------------
    public function pembayaran($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        [$harga, $dp] = $this->hitungHargaDp($reservasi->paket);

        return view('reservasi.konfirmasi.pembayaran', compact('reservasi', 'harga', 'dp'));
    }

    // --------------------------------------------------------
    // Submit form reservasi → simpan ke DB → redirect ke pembayaran
    // --------------------------------------------------------
    public function submit(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'telp_pemohon' => 'required|string|max:20',
            'foto_ktp_cpp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_ktp_cpw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $surat   = $request->hasFile('surat_rekomendasi') ? $request->file('surat_rekomendasi')->store('dokumen_reservasi', 'public') : null;
        $ktp_cpp = $request->hasFile('foto_ktp_cpp')      ? $request->file('foto_ktp_cpp')->store('dokumen_reservasi', 'public')      : null;
        $ktp_cpw = $request->hasFile('foto_ktp_cpw')      ? $request->file('foto_ktp_cpw')->store('dokumen_reservasi', 'public')      : null;
        $foto_cpp = $request->hasFile('foto_cpp_3x4')     ? $request->file('foto_cpp_3x4')->store('dokumen_reservasi', 'public')      : null;
        $foto_cpw = $request->hasFile('foto_cpw_3x4')     ? $request->file('foto_cpw_3x4')->store('dokumen_reservasi', 'public')      : null;

        $reservasi = Reservasi::create([
            'user_id'         => Auth::id(),
            'paket'           => $request->paket,
            'tanggal'         => $request->tanggal,
            'sesi'            => $request->sesi,
            'status'          => 'Menunggu Verifikasi Admin',
            'status_dp'       => 'menunggu',
            'nama_pemohon'    => $request->nama_pemohon,
            'alamat_pemohon'  => $request->alamat_pemohon,
            'telp_pemohon'    => $request->telp_pemohon,
            'nama_cpp'        => $request->nama_cpp,
            'bin_cpp'         => $request->bin_cpp,
            'alamat_cpp'      => $request->alamat_cpp,
            'telp_cpp'        => $request->telp_cpp,
            'nama_cpw'        => $request->nama_cpw,
            'binti_cpw'       => $request->binti_cpw,
            'alamat_cpw'      => $request->alamat_cpw,
            'telp_cpw'        => $request->telp_cpw,
            'nama_wali'       => $request->nama_wali,
            'alamat_wali'     => $request->alamat_wali,
            'telp_wali'       => $request->telp_wali,
            'kua_kecamatan'   => $request->kua_kecamatan,
            'surat_rekomendasi' => $surat,
            'foto_ktp_cpp'    => $ktp_cpp,
            'foto_ktp_cpw'    => $ktp_cpw,
            'foto_cpp_3x4'    => $foto_cpp,
            'foto_cpw_3x4'    => $foto_cpw,
            'nominal_dp' => $this->hitungHargaDp($request->paket)[1],
        ]);

        return redirect()->route('reservasi.pembayaran', ['id' => $reservasi->id]);
    }

    // --------------------------------------------------------
    // BARU: Buat Snap Token Midtrans & kembalikan ke blade (AJAX)
    // --------------------------------------------------------
    public function snapToken($id)
    {
        try {
            $reservasi = Reservasi::findOrFail($id);

            if ($reservasi->user_id !== Auth::id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            [, $dp] = $this->hitungHargaDp($reservasi->paket);
            $totalFasilitas = (int) request('total_fasilitas', 0);

            $this->configureMidtrans();

            $params = [
                'transaction_details' => [
                    'order_id'     => 'RSV-' . $reservasi->id . '-' . time(),
                    'gross_amount' => $dp + $totalFasilitas,
                ],
                'customer_details' => [
                    'first_name' => $reservasi->nama_pemohon,
                    'phone'      => $reservasi->telp_pemohon,
                ],
                'item_details' => [
                    [
                        'id'       => 'DP-' . $reservasi->id,
                        'price'    => $dp,
                        'quantity' => 1,
                        'name'     => 'DP Reservasi: ' . $reservasi->paket,
                    ],
                    ...($totalFasilitas > 0 ? [[
                        'id'       => 'FASILITAS-' . $reservasi->id,
                        'price'    => $totalFasilitas,
                        'quantity' => 1,
                        'name'     => 'Fasilitas Tambahan',
                    ]] : []),
                ],
                'callbacks' => [
                    'finish'       => route('reservasi.selesai', $reservasi->id),
                    'notification' => env('NGROK_URL') . '/midtrans/notification',
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $reservasi->update(['snap_token' => $snapToken]);
            return response()->json(['snap_token' => $snapToken]);

        } catch (\Exception $e) {
            \Log::error('MIDTRANS ERROR: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // --------------------------------------------------------
    // BARU: Cek status DP untuk polling frontend
    // --------------------------------------------------------
    public function checkStatus($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        return response()->json(['status_dp' => $reservasi->status_dp]);
    }

    // --------------------------------------------------------
    // Halaman selesai (setelah Midtrans redirect finish_url)
    // --------------------------------------------------------
    public function selesai(Request $request, $id)
    {
        return redirect('/')->with('welcome', 'Alhamdulillah, Reservasi berhasil! Silakan tunggu konfirmasi Admin.');
    }

    // --------------------------------------------------------
    // Helper: Setup konfigurasi Midtrans
    // --------------------------------------------------------
    private function configureMidtrans(): void
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    // --------------------------------------------------------
    // Helper: Tentukan harga dan DP berdasarkan paket
    // --------------------------------------------------------
    private function hitungHargaDp(string $paket): array
    {
        if (stripos($paket, 'Intimate Wedding') !== false) return [2500000, 1000000];
        if (stripos($paket, 'Wedding') !== false)         return [12500000, 3000000];
        if (stripos($paket, 'Akad') !== false)            return [3000000, 1000000];
        return [7500000, 2000000];
    }
}