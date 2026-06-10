<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login | Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%  { transform: translateX(-6px); }
            40%  { transform: translateX(6px); }
            60%  { transform: translateX(-4px); }
            80%  { transform: translateX(4px); }
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .shake      { animation: shake 0.4s ease; }
        .slide-down { animation: slideDown 0.3s ease forwards; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

    <a href="{{ route('login') }}" class="fixed top-6 left-6 text-green-700 flex items-center gap-2 font-bold z-50 bg-white/80 px-4 py-2 rounded-full shadow-sm backdrop-blur-sm hover:bg-white transition">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Login Jamaah
    </a>

    <div class="bg-white rounded-[20px] shadow-2xl flex flex-col md:flex-row max-w-3xl w-full overflow-hidden min-h-[500px]">

        <div class="w-full md:w-5/12 bg-green-700 text-white flex flex-col items-center justify-center p-8 text-center relative">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 flex flex-col items-center">
                <i class="fa-solid fa-user-shield text-6xl mb-4 text-green-200"></i>
                <h2 class="text-2xl font-bold mb-2">Portal Admin</h2>
                <p class="text-sm text-green-100">Sistem Informasi Manajemen<br>Masjid Agung Gresik</p>
            </div>
        </div>

        <div class="w-full md:w-7/12 p-8 md:p-12 flex items-center justify-center bg-white">
            <form action="{{ route('admin.login.submit') }}" method="POST"
                  class="w-full flex flex-col items-center"
                  id="loginForm">
                @csrf

                <h1 class="text-3xl font-bold mb-2 text-gray-800">Selamat Datang</h1>
                <p class="text-sm text-gray-500 mb-6 text-center">Silakan masuk untuk mengelola data masjid.</p>

                @if (session('error'))
                    <div class="slide-down w-full mb-5 bg-red-50 border border-red-200 rounded-lg px-4 py-3 flex items-start gap-3"
                         id="sessionError">
                        <div class="mt-0.5 shrink-0 w-5 h-5 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-xmark text-red-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-red-700">Login Gagal</p>
                            <p class="text-xs text-red-500 mt-0.5">{{ session('error') }}</p>
                        </div>
                        <button type="button"
                                onclick="document.getElementById('sessionError').remove()"
                                class="ml-auto shrink-0 text-red-300 hover:text-red-500 transition">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>
                @endif

                <div class="w-full relative mb-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-regular fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email"
                           name="ADMIN_EMAIL"
                           value="{{ old('ADMIN_EMAIL') }}"
                           placeholder="Email Admin"
                           class="bg-gray-50 border text-gray-800 text-sm rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent block w-full pl-10 p-3 outline-none transition
                                  {{ $errors->has('ADMIN_EMAIL') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                           required />
                </div>

                @error('ADMIN_EMAIL')
                    <p class="w-full text-xs text-red-500 mb-3 pl-1 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @else
                    <div class="mb-4"></div>
                @enderror

                <div class="w-full relative mb-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-lock text-gray-400"></i>
                    </div>
                    <input type="password"
                           name="ADMIN_PASSWORD"
                           placeholder="Password"
                           class="bg-gray-50 border text-gray-800 text-sm rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent block w-full pl-10 p-3 outline-none transition
                                  {{ $errors->has('ADMIN_PASSWORD') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                           required />
                </div>

                @error('ADMIN_PASSWORD')
                    <p class="w-full text-xs text-red-500 mb-5 pl-1 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @else
                    <div class="mb-6"></div>
                @enderror

                <button type="submit"
                        class="bg-green-700 hover:bg-green-800 text-white rounded-lg px-12 py-3 font-bold text-sm uppercase w-full shadow-md transition-colors duration-300">
                    Masuk Sebagai Admin
                </button>
            </form>
        </div>

    </div>

    @if ($errors->any() || session('error'))
        <script>
            const form = document.getElementById('loginForm');
            form.classList.add('shake');
            form.addEventListener('animationend', () => form.classList.remove('shake'));
            
        </script>
    @endif

</body>
</html>