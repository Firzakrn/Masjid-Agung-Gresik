<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    // === FUNGSI DAFTAR (REGISTER) ===
    public function register(Request $request)
    {
        // 1. Validasi input dari form HTML
        $request->validate([
            'USER_NAME' => 'required|string|max:255',
            'USER_EMAIL' => 'required|string|email|unique:users,email',
            'USER_PASSWORD' => 'required|min:6',
            'USER_GENDER' => 'required|in:L,P',
        ]);

        // 2. Simpan ke database & otomatis HASH password
        $user = User::create([
            'name' => $request->USER_NAME,
            'email' => $request->USER_EMAIL,
            'password' => Hash::make($request->USER_PASSWORD), 
            'gender' => $request->USER_GENDER,
            'role' => 'jamaah', // Default 
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('cek_email', 'Alhamdulillah, akun berhasil dibuat! Silakan cek kotak masuk Email Anda untuk mengaktifkan akun sebelum Masuk.');
    }

    // === LOGIN ===
    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'USER_EMAIL' => 'required|email',
            'USER_PASSWORD' => 'required',
        ]);

        // 2. Proses Login
        $credentials = [
            'email' => $request->USER_EMAIL,
            'password' => $request->USER_PASSWORD
        ];

        // mengecek Hash password di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

        
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            $nama = Auth::user()->name;
            return redirect()->intended('/')->with('welcome', "Selamat datang, $nama!");
        }

        // Jika salah email/password
        return back()->withErrors([
            'USER_EMAIL' => 'Email atau password yang Anda masukkan tidak sesuai.',
        ])->onlyInput('USER_EMAIL');
    }

    public function sendResetLink(Request $request)
    {
        // Validasi input email
        $request->validate(['USER_EMAIL' => 'required|email']);

        // Menggunakan sistem bawaan Laravel untuk mencari email dan mengirim link reset
        $status = Password::sendResetLink(
            ['email' => $request->USER_EMAIL]
        );

        if ($status === Password::RESET_LINK_SENT) {
            // Jika berhasil, kembali dengan pesan sukses
            return back()->with('status', 'Link reset password telah dikirim ke email Anda!');
        }

        // Jika email tidak terdaftar
        return back()->withErrors(['USER_EMAIL' => 'Email tidak ditemukan di sistem kami.']);
    }

    // === FUNGSI KELUAR (LOGOUT) ===
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}