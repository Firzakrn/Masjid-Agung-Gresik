<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
use App\Models\Zis;

class UserController extends Controller
{
    public function riwayat()
    {
        $reservasis = Reservasi::with('transaksis')
                               -> where('user_id', Auth::id())
                               ->orderBy('created_at', 'desc')
                               ->get();

        $riwayatZis = Zis::where('user_id', Auth::id())
                 ->orderBy('created_at', 'desc')
                 ->get();

        return view('riwayat', compact('reservasis', 'riwayatZis'));
    } 
}