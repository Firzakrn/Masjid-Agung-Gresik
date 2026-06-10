<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // === LOGIN & REGISTER LEWAT GOOGLE ===
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                session([
                    'google_name'  => $googleUser->getName(),
                    'google_email' => $googleUser->getEmail(),
                    'google_id'    => $googleUser->getId(),
                ]);

                return redirect('/login')->with('show_register', true)
                    ->withErrors(['USER_EMAIL' => 'Email Google Anda belum terdaftar. Silakan daftar terlebih dahulu.']);
            }

            $user->update([
                'google_id'         => $googleUser->getId(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);

            Auth::login($user);

            return redirect()->intended('/')->with('welcome', "Selamat datang, {$user->name}!");

        } catch (\Exception $e) {
            return redirect('/login')->withErrors([
                'USER_EMAIL' => 'Login Google gagal, coba lagi.'
            ]);
        }
    }

    // === FUNGSI DAFTAR (REGISTER) ===
    public function register(Request $request)
    {
        $request->validate([
            'USER_NAME'     => 'required|string|max:255',
            'USER_EMAIL'    => 'required|string|email|unique:users,email',
            'USER_PASSWORD' => 'required|min:6',
            'USER_GENDER'   => 'required|in:L,P',
        ]);

        $user = User::create([
            'name'     => $request->USER_NAME,
            'email'    => $request->USER_EMAIL,
            'password' => Hash::make($request->USER_PASSWORD),
            'gender'   => $request->USER_GENDER,
            'role'     => 'jamaah',
        ]);

        // FITUR VERIFIKASI EMAIL, DAFTAR SMTP GMAIL DAN TAMBAHKAN FUNGSINYA PADA .env
        // event(new Registered($user));

        return redirect()->route('login')->with('cek_email', 'Alhamdulillah, akun berhasil dibuat! Silakan cek kotak masuk Email Anda untuk mengaktifkan akun sebelum Masuk.');
    }

    // === FUNGSI LOGIN ===
    public function login(Request $request)
    {
        $emailName    = $request->has('ADMIN_EMAIL')    ? 'ADMIN_EMAIL'    : 'USER_EMAIL';
        $passwordName = $request->has('ADMIN_PASSWORD') ? 'ADMIN_PASSWORD' : 'USER_PASSWORD';

        $request->validate([
            $emailName    => 'required|email',
            $passwordName => 'required',
        ]);

        $email    = $request->$emailName;
        $password = $request->$passwordName;

        $user = User::where('email', $email)->first();

        if ($user && (is_null($user->password) || $user->password === '')) {
            return back()->withErrors([
                $emailName => 'Akun ini terdaftar via Google. Silakan gunakan tombol "Login dengan Google", atau klik "Lupa password?" untuk membuat password baru.',
            ])->onlyInput($emailName);
        }

        $credentials = [
            'email'    => $email,
            'password' => $password,
        ];

        if (Auth::attempt($credentials)) {
            $user            = Auth::user();
            $loginLewatAdmin = $request->is('admin*');

            if ($user->role === 'admin' && !$loginLewatAdmin) {
                Auth::logout();
                return back()->withErrors([$emailName => 'Email atau password yang Anda masukkan tidak sesuai.'])->onlyInput($emailName);
            }

            if ($user->role === 'jamaah' && $loginLewatAdmin) {
                Auth::logout();
                return back()->withErrors([$emailName => 'Email atau password yang Anda masukkan tidak sesuai.'])->onlyInput($emailName);
            }

            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect()->intended('/')->with('welcome', "Selamat datang, {$user->name}!");
        }

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