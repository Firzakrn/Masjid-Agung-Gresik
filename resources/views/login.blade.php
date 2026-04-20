<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk & Daftar | Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        /* JS Toggle Utility - Tetap ditaruh di sini karena ini CSS murni bukan Tailwind */
        .hidden-form {
            display: none !important;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <a href="{{ route('home') }}" class="fixed top-6 left-6 text-green-700 flex items-center gap-2 font-bold z-50 bg-white/80 px-4 py-2 rounded-full shadow-sm backdrop-blur-sm hover:bg-white transition">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>

    <div class="bg-white rounded-[20px] shadow-2xl relative max-w-4xl w-full flex flex-col-reverse md:flex-row overflow-hidden min-h-[600px]" id="container">

        <div class="w-full md:w-1/2 p-8 md:p-12 relative flex items-center justify-center bg-white">

            <form action="{{ route('login') }}" method="POST" id="signInForm" class="w-full flex flex-col items-center text-center transition-all duration-300">
                @csrf
                <h1 class="text-3xl font-bold mb-6 text-green-700">Masuk</h1>

                <div class="flex gap-3 mb-5 w-full">
                    <a href="{{ url('auth/google') }}" class="flex-1 border border-gray-300 rounded-lg py-2.5 flex items-center justify-center gap-2 hover:bg-gray-50 transition">
                        <i class="fa-brands fa-google text-red-500 text-lg"></i>
                        <span class="text-xs font-bold text-gray-600">Google</span>
                    </a>
                    <a href="{{ url('auth/facebook') }}" class="flex-1 border border-gray-300 rounded-lg py-2.5 flex items-center justify-center gap-2 hover:bg-gray-50 transition">
                        <i class="fa-brands fa-facebook-f text-blue-600 text-lg"></i>
                        <span class="text-xs font-bold text-gray-600">Facebook</span>
                    </a>
                </div>

                <div class="flex items-center w-full mb-5">
                    <hr class="flex-grow border-gray-200">
                    <span class="px-3 text-xs text-gray-400">atau</span>
                    <hr class="flex-grow border-gray-200">
                </div>

                <input type="email" name="USER_EMAIL" id="loginEmail" placeholder="Email" class="w-full bg-white border border-gray-300 px-4 py-3 mb-4 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition" required />
                <input type="password" name="USER_PASSWORD" id="loginPassword" placeholder="Password" class="w-full bg-white border border-gray-300 px-4 py-3 mb-4 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition" required />
                
                <div class="w-full flex justify-end mb-6">
                    <a id="forgotPassBtn" class="text-xs text-gray-500 hover:text-green-700 hover:underline cursor-pointer">
                        Lupa password?
                    </a>
                </div>

                <button type="submit" class="w-full bg-green-700 text-white hover:bg-green-800 rounded-full px-12 py-3.5 font-bold text-xs uppercase shadow-md transition-colors duration-300 mb-6">
                    Masuk
                </button>

                <div id="welcomeLogin" class="flex flex-col items-center w-full mt-2 pt-4 border-t border-gray-100">
                    <p class="mb-3 text-xs text-gray-500">Belum punya akun?</p>
                    <button type="button" class="w-[80%] border-2 border-green-600 text-green-600 hover:bg-green-50 rounded-full px-12 py-2.5 font-bold text-xs uppercase transition-colors duration-300" id="showSignUpBtn">Daftar Sekarang</button>
                </div>
            </form>

            <form action="{{ route('register') }}" method="POST" id="signUpForm" class="w-full flex flex-col items-center text-center hidden-form transition-all duration-300 absolute px-8 md:px-12">
                @csrf
                <h1 class="text-3xl font-bold mb-2 text-green-700">Buat Akun</h1>

                <div class="flex gap-3 mb-5 w-full">
                    <a href="{{ url('auth/google') }}" class="flex-1 border border-gray-300 rounded-lg py-2.5 flex items-center justify-center gap-2 hover:bg-gray-50 transition">
                        <i class="fa-brands fa-google text-red-500 text-lg"></i>
                        <span class="text-xs font-bold text-gray-600">Google</span>
                    </a>
                    <a href="{{ url('auth/facebook') }}" class="flex-1 border border-gray-300 rounded-lg py-2.5 flex items-center justify-center gap-2 hover:bg-gray-50 transition">
                        <i class="fa-brands fa-facebook-f text-blue-600 text-lg"></i>
                        <span class="text-xs font-bold text-gray-600">Facebook</span>
                    </a>
                </div>

                <div class="flex items-center w-full mb-5">
                    <hr class="flex-grow border-gray-200">
                    <span class="px-3 text-xs text-gray-400">atau</span>
                    <hr class="flex-grow border-gray-200">
                </div>

                <input type="text" name="USER_NAME" placeholder="Username" class="w-full bg-white border border-gray-300 px-4 py-3 mb-4 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition" required />
                <input type="email" name="USER_EMAIL" placeholder="Email" class="w-full bg-white border border-gray-300 px-4 py-3 mb-4 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition" required />
                <input type="password" name="USER_PASSWORD" placeholder="Password" class="w-full bg-white border border-gray-300 px-4 py-3 mb-4 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition" required />
                
                <div class="flex justify-center gap-6 w-full mb-5 px-2 bg-gray-50 border border-gray-200 py-3 rounded-lg">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer hover:text-green-700 transition font-medium">
                        <input type="radio" name="USER_GENDER" value="L" class="w-4 h-4 text-green-600 focus:ring-green-500 cursor-pointer" required>
                        Laki-laki
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer hover:text-green-700 transition font-medium">
                        <input type="radio" name="USER_GENDER" value="P" class="w-4 h-4 text-green-600 focus:ring-green-500 cursor-pointer" required>
                        Perempuan
                    </label>
                </div>

                <button type="submit" class="w-full bg-green-700 text-white hover:bg-green-800 rounded-full px-12 py-3.5 mt-2 font-bold text-xs uppercase shadow-md transition-colors duration-300 mb-2">
                    Daftar
                </button>

                <div id="welcomeRegister" class="flex flex-col items-center w-full pt-4 border-t border-gray-100">
                    <p class="mb-3 text-xs text-gray-500">Sudah punya akun?</p>
                    <button type="button" class="w-[80%] border-2 border-green-600 text-green-600 hover:bg-green-50 rounded-full px-12 py-2.5 font-bold text-xs uppercase transition-colors duration-300" id="showSignInBtn">Masuk di Sini</button>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 relative min-h-[350px] md:min-h-full flex flex-col items-center justify-center px-8 py-10 text-center">
            <img src="{{ asset('images/login_screen.png') }}" alt="Background Masjid" class="absolute inset-0 w-full h-full object-cover">
            
            <div class="absolute inset-0 bg-black/40"></div>

            <div class="relative z-10 text-white flex flex-col items-center justify-center h-full w-full">
                <h1 class="text-3xl md:text-4xl font-bold mb-4 drop-shadow-md">Assalamualaikum!</h1>
                <p class="text-sm text-white drop-shadow-md font-medium px-4">Sahabat muslimin mohon daftar atau login terlebih dahulu untuk bisa infaq, zakat dan donasi.</p>
            </div>

            <div class="relative z-10 mt-auto pt-6">
                <a href="{{ route('admin.login') }}" class="text-xs text-gray-200 hover:text-white hover:underline transition bg-black/30 px-4 py-2 rounded-full backdrop-blur-sm">
                    <i class="fa-solid fa-user-shield mr-1"></i> Login Sebagai Admin
                </a>
            </div>
        </div>
    </div>

    <script>
        const signInForm = document.getElementById('signInForm');
        const signUpForm = document.getElementById('signUpForm');
        
        const showSignUpBtn = document.getElementById('showSignUpBtn');
        const showSignInBtn = document.getElementById('showSignInBtn');

        showSignUpBtn.onclick = (e) => {
            e.preventDefault();
            signInForm.classList.add('hidden-form');
            signUpForm.classList.remove('hidden-form');
        };

        showSignInBtn.onclick = (e) => {
            e.preventDefault();
            signUpForm.classList.add('hidden-form');
            signInForm.classList.remove('hidden-form');
        };

        document.getElementById('forgotPassBtn').onclick = () => {
            const email = document.getElementById('loginEmail').value;
            if (!email) {
                alert('Silakan masukkan alamat email Anda terlebih dahulu pada form Masuk.');
                return;
            }
            alert('Tautan reset password telah dikirim ke: ' + email);
        };
    </script>
</body>
</html>