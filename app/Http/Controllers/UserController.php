<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
// use App\Models\Zis; // Hapus tanda // jika kamu sudah punya model ZIS/Infaq

class UserController extends Controller
{
    public function riwayat()
    {
        // 1. Tarik riwayat reservasi milik pemohon yang sedang login
        $reservasis = Reservasi::where('user_id', Auth::id())
                               ->orderBy('created_at', 'desc')
                               ->get();

        // 2. Tarik riwayat ZIS. 
        // (Contoh ini pakai array dummy karena aku belum tahu struktur tabel ZIS-mu. 
        // Nanti bisa kamu ganti pakai query Eloquent seperti reservasi di atas).
        $riwayatZis = [
            (object)[
                'jenis' => 'Zakat Fitrah',
                'tanggal' => '2026-04-20',
                'nominal' => 150000,
                'status' => 'Berhasil'
            ],
            (object)[
                'jenis' => 'Infaq Pembangunan',
                'tanggal' => '2026-03-15',
                'nominal' => 500000,
                'status' => 'Menunggu Verifikasi'
            ]
        ];

        return view('riwayat', compact('reservasis', 'riwayatZis'));
    }
}