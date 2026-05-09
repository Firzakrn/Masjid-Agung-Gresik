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

        // 2. Buat variabel kosong sementara untuk ZIS (karena modelnya belum aktif)
        // Ini mencegah error "Undefined variable" di halaman riwayat
        $riwayatZis = [];

        return view('riwayat', compact('reservasis', 'riwayatZis'));
    }
}