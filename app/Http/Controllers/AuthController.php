<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // === FUNGSI DAFTAR (REGISTER) ===
    public function register(Request $request)
    {
        $request->validate([
            'USER_NAME' => 'required|string|max:255',
            'USER_EMAIL' => 'required|string|email|unique:users,email',
            'USER_PASSWORD' => 'required|min:6',
            'USER_GENDER' => 'required|in:L,P',
        ]);

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

    // === LOGIN (SUDAH DIPERBAIKI) ===
    public function login(Request $request)
    {
        // 1. Cek cerdas: Apakah form mengirim ADMIN_EMAIL atau USER_EMAIL?
        $emailName = $request->has('ADMIN_EMAIL') ? 'ADMIN_EMAIL' : 'USER_EMAIL';
        $passwordName = $request->has('ADMIN_PASSWORD') ? 'ADMIN_PASSWORD' : 'USER_PASSWORD';

        // 2. Validasi input yang masuk
        $request->validate([
            $emailName => 'required|email',
            $passwordName => 'required',
        ]);

        $credentials = [
            'email' => $request->$emailName,
            'password' => $request->$passwordName
        ];

        // 3. Cek database: Apakah email & password benar?
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $loginLewatAdmin = $request->is('admin*'); // Ngecek URL apakah ada kata 'admin'

            // Pengecekan Murni Berdasarkan Kolom 'role' di Database
            if ($user->role === 'admin' && !$loginLewatAdmin) {
                Auth::logout();
                return back()->withErrors([$emailName => 'Email atau password yang Anda masukkan tidak sesuai.'])->onlyInput($emailName);
            }

            if ($user->role === 'jamaah' && $loginLewatAdmin) {
                Auth::logout();
                return back()->withErrors([$emailName => 'Email atau password yang Anda masukkan tidak sesuai.'])->onlyInput($emailName);
            }

            // Jika lolos semua, arahkan ke kamarnya masing-masing
            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect()->intended('/')->with('welcome', "Selamat datang, {$user->name}!");
        }

        // Jika email/password memang salah
        return back()->withErrors([
            $emailName => 'Email atau password yang Anda masukkan tidak sesuai.',
        ])->onlyInput($emailName);
    }

    // === FUNGSI RESET PASSWORD ===
    public function sendResetLink(Request $request)
    {
        $request->validate(['USER_EMAIL' => 'required|email']);

        $status = Password::sendResetLink(
            ['email' => $request->USER_EMAIL]
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'Link reset password telah dikirim ke email Anda!');
        }

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