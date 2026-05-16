<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verifikasi Email | Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    
    <div class="bg-white rounded-[20px] shadow-2xl max-w-md w-full p-8 text-center relative overflow-hidden">
        
        <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fa-solid fa-envelope-circle-check text-4xl text-green-600"></i>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 mb-3">Verifikasi Email Anda</h1>
        
        <p class="text-sm text-gray-500 mb-6 leading-relaxed">
            Terima kasih telah mendaftar! Sebelum bisa menggunakan layanan reservasi dan ZIS, mohon verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan ke kotak masuk (atau folder Spam) Anda.
        </p>

        @if (session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm font-medium">
                <i class="fa-solid fa-check-circle mr-1"></i> Tautan verifikasi baru telah dikirim!
            </div>
        @endif

        <div class="flex flex-col gap-4">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full bg-green-700 text-white hover:bg-green-800 rounded-full py-3.5 font-bold text-xs uppercase shadow-md transition-colors duration-300 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full border-2 border-gray-300 text-gray-600 hover:bg-gray-50 rounded-full py-3 font-bold text-xs uppercase transition-colors duration-300">
                    Keluar / Ganti Akun
                </button>
            </form>
        </div>

    </div>

</body>
</html>