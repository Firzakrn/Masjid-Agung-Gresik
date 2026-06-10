<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\CoreApi;

class ReservasiController extends Controller
{
    // --------------------------------------------------------
    // Halaman pilih tanggal & sesi
    // --------------------------------------------------------
    public function tanggalSesi(Request $request)
    {
        $paket = $request->query('paket', 'Paket Belum Dipilih');

        $reservasis = Reservasi::whereNotIn('status', [
            'Batal', 
            'Ditolak', 
            'Tanggal Ditolak', 
            'DP Ditolak'
        ])->get();

        $bookedDates = [];

        $bulanIndo = [
            'Januari' => '01', 'Februari' => '02', 'Maret' => '03', 'April' => '04',
            'Mei' => '05', 'Juni' => '06', 'Juli' => '07', 'Agustus' => '08',
            'September' => '09', 'Oktober' => '10', 'November' => '11', 'Desember' => '12'
        ];

        foreach ($reservasis as $rsv) {
            $parts = explode(' ', $rsv->tanggal);
            if (count($parts) === 3) {
                $day   = str_pad($parts[0], 2, '0', STR_PAD_LEFT);
                $month = $bulanIndo[$parts[1]] ?? '01';
                $year  = $parts[2];
                $tglFormatted = "$year-$month-$day";

                $sesiLokal = strtolower($rsv->sesi);
                $jenisSesi = str_contains($sesiLokal, 'malam') ? 'malam' : 'pagi';

                if (isset($bookedDates[$tglFormatted])) {
                    if ($bookedDates[$tglFormatted] !== $jenisSesi) {
                        $bookedDates[$tglFormatted] = 'full';
                    }
                } else {
                    $bookedDates[$tglFormatted] = $jenisSesi;
                }
            }
        }

        return view('reservasi.konfirmasi.tgl-sesi', compact('paket', 'bookedDates'));
    }

    public function ajukanTanggal(Request $request)
    {
        $request->validate([
            'paket' => 'required',
            'tanggal' => 'required',
            'sesi' => 'required',
        ]);

        $user = Auth::user();

        Reservasi::create([
            'user_id' => $user->id,
            'paket' => $request->paket,
            'tanggal' => $request->tanggal,
            'sesi' => $request->sesi,
            'status' => 'Menunggu Konfirmasi Tanggal', 
            'status_dp' => 'menunggu',
            
            // Dummy data sementara
            'nama_pemohon' => $user->name ?? '-',
            'alamat_pemohon' => '-',
            'telp_pemohon' => '-',
            'nominal_dp' => 0,
            'grand_total' => 0,
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Jadwal berhasil diajukan! Tanggal sudah kami amankan, silakan tunggu konfirmasi Admin.');
    }

    // --------------------------------------------------------
    // Tampilkan formulir reservasi
    // --------------------------------------------------------
    public function formReservasi(Request $request)
    {
        $paket   = $request->query('paket', 'Paket Belum Dipilih');
        $tanggal = $request->query('tanggal', '-');
        $sesi    = $request->query('sesi', '-');
        
        $id = $request->query('id');
        $reservasi = Reservasi::find($id);
        
        $harga   = 12500000;
        $dp      = 3000000;

        return view('reservasi.konfirmasi.formulir', compact('paket', 'tanggal', 'sesi', 'harga', 'dp', 'reservasi'));
    }

    // --------------------------------------------------------
    // Halaman pembayaran DP
    // --------------------------------------------------------
    public function pembayaran($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        [$harga, $dp] = $this->hitungHargaDp($reservasi->paket);

        return view('reservasi.konfirmasi.pembayaran', compact('reservasi', 'harga', 'dp'));
    }

    // --------------------------------------------------------
    // Tampilkan QR Code QRIS via Midtrans CoreApi
    // --------------------------------------------------------
    public function getQrCode($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $this->configureMidtrans();

        $params = [
            'payment_type' => 'qris',
            'transaction_details' => [
                'order_id'     => 'RSV-' . $reservasi->id . '-' . time(),
                'gross_amount' => $reservasi->nominal_dp,
            ],
            'customer_details' => [
                'first_name' => $reservasi->nama_pemohon,
                'phone'      => $reservasi->telp_pemohon,
            ],
        ];

        try {
            $response = CoreApi::charge($params);

            $qrCodeUrl = null;
            foreach ($response->actions as $action) {
                if ($action->name === 'generate-qr-code') {
                    $qrCodeUrl = $action->url;
                    break;
                }
            }

            return view('reservasi.bayar_qris', compact('qrCodeUrl', 'reservasi'));

        } catch (\Exception $e) {
            return back()->withErrors(['midtrans' => $e->getMessage()]);
        }
    }

    // --------------------------------------------------------
    // Submit formulir reservasi > simpan ke DB > redirect ke pembayaran
    // --------------------------------------------------------
    public function submit(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'telp_pemohon' => 'required|string|max:20',
            'foto_ktp_cpp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_ktp_cpw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $reservasi = Reservasi::findOrFail($request->reservasi_id);

        $uploadManual = function ($request, $nama_input, $old_file = null) {
            if ($request->hasFile($nama_input)) {
                if ($old_file && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $old_file)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $old_file); 
                }

                $file      = $request->file($nama_input);
                $nama_file = time() . '_' . $file->hashName();
                $file->move($_SERVER['DOCUMENT_ROOT'] . '/dokumen_reservasi', $nama_file);
                return 'dokumen_reservasi/' . $nama_file;
            }
            return null;
        };

        $surat    = $uploadManual($request, 'surat_rekomendasi', $reservasi->surat_rekomendasi);
        $ktp_cpp  = $uploadManual($request, 'foto_ktp_cpp', $reservasi->foto_ktp_cpp);
        $ktp_cpw  = $uploadManual($request, 'foto_ktp_cpw', $reservasi->foto_ktp_cpw);
        $foto_cpp = $uploadManual($request, 'foto_cpp_3x4', $reservasi->foto_cpp_3x4);
        $foto_cpw = $uploadManual($request, 'foto_cpw_3x4', $reservasi->foto_cpw_3x4);

        [$harga, $dp] = $this->hitungHargaDp($request->paket);

        $reservasi = Reservasi::findOrFail($request->reservasi_id);
        
        $reservasi->update([
            'user_id'           => Auth::id(),
            'paket'             => $request->paket,
            'tanggal'           => $request->tanggal,
            'sesi'              => $request->sesi,
            'status'            => 'Menunggu Pembayaran DP',
            'status_dp'         => 'menunggu',
            'nama_pemohon'      => $request->nama_pemohon,
            'alamat_pemohon'    => $request->alamat_pemohon,
            'telp_pemohon'      => $request->telp_pemohon,
            'memo_pemohon'      => $request->memo_pemohon,
            'nama_cpp'          => $request->nama_cpp,
            'bin_cpp'           => $request->bin_cpp,
            'alamat_cpp'        => $request->alamat_cpp,
            'telp_cpp'          => $request->telp_cpp,
            'nama_cpw'          => $request->nama_cpw,
            'binti_cpw'         => $request->binti_cpw,
            'alamat_cpw'        => $request->alamat_cpw,
            'telp_cpw'          => $request->telp_cpw,
            'nama_wali'         => $request->nama_wali,
            'alamat_wali'       => $request->alamat_wali,
            'telp_wali'         => $request->telp_wali,
            'kua_kecamatan'     => $request->kua_kecamatan,
            
            'surat_rekomendasi' => $surat ?? $reservasi->surat_rekomendasi,
            'foto_ktp_cpp'      => $ktp_cpp ?? $reservasi->foto_ktp_cpp,
            'foto_ktp_cpw'      => $ktp_cpw ?? $reservasi->foto_ktp_cpw,
            'foto_cpp_3x4'      => $foto_cpp ?? $reservasi->foto_cpp_3x4,
            'foto_cpw_3x4'      => $foto_cpw ?? $reservasi->foto_cpw_3x4,
            
            'grand_total'       => $harga,
            'nominal_dp'        => $dp,
        ]);

        return redirect()->route('reservasi.pembayaran', ['id' => $reservasi->id]);
    }

    // --------------------------------------------------------
    // Halaman Bayar Snap Token Midtrans untuk pembayaran DP 
    // --------------------------------------------------------
    public function snapToken(Request $request, $id)
    {
        try {
            $reservasi = Reservasi::findOrFail($id);

            $totalFasilitas = $request->total_fasilitas ?? 0;

            if ($totalFasilitas > 0) {
                $reservasi->update([
                    'grand_total' => $reservasi->grand_total + $totalFasilitas
                ]);
            }

            $this->configureMidtrans();
            
            $orderId = 'RSV-' . $reservasi->id . '-' . time();

            $params = [
                'enabled_payments' => ['qris', 'gopay', 'shopeepay', 'bca_va', 'bni_va', 'bri_va', 'mandiri_va'],
                'transaction_details' => [
                    'order_id'     => $orderId,
                    'gross_amount' => $reservasi->nominal_dp, 
                ],
                'customer_details' => [
                    'first_name' => $reservasi->nama_pemohon,
                    'phone'      => $reservasi->telp_pemohon,
                ],
                'item_details' => [
                    [
                        'id'       => 'DP-' . $reservasi->id,
                        'price'    => $reservasi->nominal_dp,
                        'quantity' => 1,
                        'name'     => 'DP Reservasi: ' . $reservasi->paket,
                    ]
                ],
                'callbacks' => [
                    'finish'       => route('reservasi.selesai', $reservasi->id) . '?order_id=' . $orderId,
                    'notification' => url('/midtrans/notification'),
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            return response()->json(['snap_token' => $snapToken]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // --------------------------------------------------------
    // Halaman pelunasan sisa pembayaran
    // --------------------------------------------------------
    public function pelunasan($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        if (!$reservasi->grand_total || $reservasi->grand_total == 0) {
            [$harga, $dp] = $this->hitungHargaDp($reservasi->paket);
            $reservasi->grand_total = $harga;
            $reservasi->nominal_dp  = $reservasi->nominal_dp ?: $dp;
            $reservasi->save();
        }

        $sisaBayar = $reservasi->grand_total - $reservasi->nominal_dp;

        return view('reservasi.konfirmasi.pelunasan', compact('reservasi', 'sisaBayar'));
    }

    // --------------------------------------------------------
    // Buat Snap Token Midtrans untuk pelunasan (AJAX)
    // --------------------------------------------------------
    public function snapTokenLunas($id)
    {
        try {
            $reservasi = Reservasi::findOrFail($id);

            if ($reservasi->user_id !== Auth::id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            if (!$reservasi->grand_total || $reservasi->grand_total == 0) {
                [$harga, $dp] = $this->hitungHargaDp($reservasi->paket);
                $reservasi->grand_total = $harga;
                $reservasi->nominal_dp  = $reservasi->nominal_dp ?: $dp;
                $reservasi->save();
            }

            $sisaBayar = $reservasi->grand_total - $reservasi->nominal_dp;

            $this->configureMidtrans();

            $orderId = 'LUNAS-' . $reservasi->id . '-' . time();

            $params = [
                'enabled_payments' => ['qris', 'gopay', 'shopeepay', 'bca_va', 'bni_va', 'bri_va', 'mandiri_va'],
                'transaction_details' => [
                    'order_id'     => $orderId,
                    'gross_amount' => $sisaBayar,
                ],
                'customer_details' => [
                    'first_name' => $reservasi->nama_pemohon,
                    'phone'      => $reservasi->telp_pemohon,
                ],
                'item_details' => [
                    [
                        'id'       => 'LUNAS-' . $reservasi->id,
                        'price'    => $sisaBayar,
                        'quantity' => 1,
                        'name'     => 'Pelunasan: ' . $reservasi->paket,
                    ]
                ],
                'callbacks' => [
                    'finish'       => route('reservasi.selesai', $reservasi->id) . '?order_id=' . $orderId,
                    'notification' => url('/midtrans/notification'),
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            return response()->json(['snap_token' => $snapToken]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // --------------------------------------------------------
    // Cek status DP 
    // --------------------------------------------------------
    public function checkStatus($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        return response()->json(['status_dp' => $reservasi->status_dp]);
    }

    // --------------------------------------------------------
    // Halaman selesai setelah redirect dari Midtrans / WhatsApp
    // --------------------------------------------------------
    public function selesai(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $orderId = $request->query('order_id', '');

        if (str_starts_with($orderId, 'LUNAS-')) {
            $reservasi->update([
                'status_dp' => 'dp_lunas_pending',
                'status'    => 'DP Lunas – Menunggu Konfirmasi Admin',
            ]);
        } elseif (str_starts_with($orderId, 'RSV-')) {
            // === JALUR MIDTRANS OTOMATIS ===
            // Data baru dimunculkan ke Admin setelah pembayaran sukses
            $reservasi->update([
                'status_dp' => 'menunggu',
                'status'    => 'Menunggu Verifikasi Admin',
            ]);
        } else {
            // === JALUR MANUAL WHATSAPP ===
            // Karena tombol WA tidak membawa order_id, script JS tutupOtomatis() akan lari ke sini.
            // Di titik inilah kita "menyimpan" komitmen bayar mereka ke database agar muncul di Admin.
            if ($reservasi->status === 'Menunggu Pembayaran DP') {
                $reservasi->update([
                    'status_dp' => 'menunggu',
                    'status'    => 'Menunggu Verifikasi Admin', // Munculkan ke Admin!
                ]);
            }
        }

        return redirect('/')->with('welcome', 'Alhamdulillah! Proses selesai. Menunggu konfirmasi Admin.');
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
        if (stripos($paket, 'Wedding') !== false)          return [12500000, 3000000];
        if (stripos($paket, 'Akad') !== false)             return [3000000, 1000000];
        return [7500000, 2000000];
    }
}