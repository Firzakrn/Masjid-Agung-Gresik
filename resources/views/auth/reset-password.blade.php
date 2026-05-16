<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password | Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-[20px] shadow-2xl max-w-md w-full p-10 text-center">
        <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-key text-2xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-green-700 mb-2">Reset Password</h1>
        <p class="text-sm text-gray-500 mb-6">Masukkan password baru untuk akun <strong>{{ $email }}</strong></p>

        @if($errors->has('token'))
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm font-semibold mb-5 flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ $errors->first('token') }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <input type="password" name="password"
                   placeholder="Password baru (min. 8 karakter)"
                   class="w-full border px-4 py-3 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition mb-2
                          {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                   required />
            @error('password')
                <p class="text-xs text-red-500 mb-3 pl-1 text-left flex items-center gap-1">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                </p>
            @enderror

            <input type="password" name="password_confirmation"
                   placeholder="Konfirmasi password baru"
                   class="w-full border px-4 py-3 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition mb-2 mt-2 border-gray-300"
                   required />

            <button type="submit" class="w-full bg-green-700 text-white hover:bg-green-800 rounded-full py-3.5 font-bold text-xs uppercase shadow-md transition mt-4">
                Simpan Password Baru
            </button>
        </form>
    </div>

</body>
</html>