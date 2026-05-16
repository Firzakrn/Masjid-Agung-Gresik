<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
use App\Models\Zis;

class UserController extends Controller
{
    // function bisa untuk mengatur pengalihan halaman, 
    //      validasi input user, letak logika CRUD
    public function riwayat()
    {
        // 1. Tarik riwayat reservasi milik pemohon yang sedang login
        $reservasis = Reservasi::where('user_id', Auth::id())
                               ->orderBy('created_at', 'desc')
                               ->get();

        // 2. Buat variabel kosong sementara untuk ZIS (karena modelnya belum aktif)
        // Ini mencegah error "Undefined variable" di halaman riwayat
        $riwayatZis = Zis::where('user_id', Auth::id())
                 ->orderBy('created_at', 'desc')
                 ->get();

        return view('riwayat', compact('reservasis', 'riwayatZis'));
    } 
}