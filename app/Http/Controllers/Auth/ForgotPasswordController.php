<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak terdaftar.',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email'      => $request->email,
            'token'      => hash('sha256', $token),
            'created_at' => Carbon::now(),
        ]);

        $resetLink = route('password.reset', ['token' => $token]) . '?email=' . urlencode($request->email);

        Mail::send('emails.reset-password', ['link' => $resetLink], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Reset Password - Masjid Agung Gresik');
        });

        return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
    }
}