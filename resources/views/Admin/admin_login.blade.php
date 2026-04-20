<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login | Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">
    
    <a href="{{ route('login') }}" class="fixed top-6 left-6 text-green-700 flex items-center gap-2 font-bold z-50 bg-white/80 px-4 py-2 rounded-full shadow-sm backdrop-blur-sm hover:bg-white transition">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Login Jamaah
    </a>

    <div class="bg-white rounded-[20px] shadow-2xl flex flex-col md:flex-row max-w-3xl w-full overflow-hidden min-h-[500px]">
        
        <div class="w-full md:w-5/12 bg-green-700 text-white flex flex-col items-center justify-center p-8 text-center relative">
            <div class="absolute inset-0 bg-black/20"></div> <div class="relative z-10 flex flex-col items-center">
                <i class="fa-solid fa-user-shield text-6xl mb-4 text-green-200"></i>
                <h2 class="text-2xl font-bold mb-2">Portal Admin</h2>
                <p class="text-sm text-green-100">Sistem Informasi Manajemen<br>Masjid Agung Gresik</p>
            </div>
        </div>

        <div class="w-full md:w-7/12 p-8 md:p-12 flex items-center justify-center bg-white">
            <form action="{{ route('admin.login.submit') }}" method="POST" class="w-full flex flex-col items-center">
                @csrf
                <h1 class="text-3xl font-bold mb-2 text-gray-800">Selamat Datang</h1>
                <p class="text-sm text-gray-500 mb-8 text-center">Silakan masuk untuk mengelola data masjid.</p>

                <div class="w-full relative mb-4">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-regular fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="ADMIN_EMAIL" placeholder="Email Admin" class="bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent block w-full pl-10 p-3 outline-none transition" required />
                </div>

                <div class="w-full relative mb-6">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" name="ADMIN_PASSWORD" placeholder="Password" class="bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent block w-full pl-10 p-3 outline-none transition" required />
                </div>

                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white rounded-lg px-12 py-3 font-bold text-sm uppercase w-full shadow-md transition-colors duration-300">
                    Masuk Sebagai Admin
                </button>
            </form>
        </div>
        
    </div>

</body>
</html>