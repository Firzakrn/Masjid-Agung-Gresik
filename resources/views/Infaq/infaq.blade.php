<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infaq - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    
    @include('navbar')

    <main class="flex-grow max-w-4xl mx-auto px-4 py-12 w-full">
        
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-green-800 mb-3">Infaq & Sedekah</h1>
            <p class="text-gray-600">Mari sucikan harta dan raih pahala jariyah dengan berinfaq untuk kemakmuran Masjid Agung Gresik.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8 md:p-12 text-center mb-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-green-400 to-green-700"></div>

            <h2 class="text-2xl font-bold text-gray-800 mb-6">Scan QRIS</h2>
            
            <div class="flex justify-center mb-6">
                <div class="p-4 border-4 border-green-100 rounded-2xl shadow-sm inline-block bg-white">
                    <img src="{{ asset('images/infaq.jpeg') }}" alt="QRIS Masjid Agung Gresik" class="w-full max-w-[300px] md:max-w-[400px] object-contain rounded-xl">
                </div>
            </div>

            <a href="{{ asset('images/infaq.jpeg') }}" download="QRIS_Masjid_Agung_Gresik.jpeg" class="inline-flex items-center justify-center gap-2 bg-green-50 text-green-700 hover:bg-green-100 px-6 py-2 rounded-full font-semibold transition-colors duration-300 mb-6 text-sm border border-green-200">
                <i class="fa-solid fa-download"></i> Simpan Gambar QRIS
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-10">
            <h3 class="text-xl font-bold text-green-800 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-green-500"></i> Cara Berinfaq via QRIS
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200">1</div>
                    <div>
                        <h4 class="font-bold text-gray-800">Buka Aplikasi</h4>
                        <p class="text-sm text-gray-600 mt-1">Buka aplikasi Mobile Banking atau E-Wallet (GoPay, OVO, DANA, ShopeePay) di HP Anda.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200">2</div>
                    <div>
                        <h4 class="font-bold text-gray-800">Pilih Menu Scan</h4>
                        <p class="text-sm text-gray-600 mt-1">Pilih ikon/menu Scan QR. Arahkan kamera ke gambar QRIS di atas, atau pilih dari galeri jika Anda sudah menyimpannya.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200">3</div>
                    <div>
                        <h4 class="font-bold text-gray-800">Masukkan Nominal</h4>
                        <p class="text-sm text-gray-600 mt-1">Masukkan nominal infaq yang ingin Anda berikan, lalu pastikan nama penerima adalah <strong>Masjid Agung Gresik</strong>.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200">4</div>
                    <div>
                        <h4 class="font-bold text-gray-800">Selesaikan Pembayaran</h4>
                        <p class="text-sm text-gray-600 mt-1">Masukkan PIN aplikasi Anda untuk menyelesaikan transaksi. Jangan lupa simpan bukti transfer.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center bg-green-800 rounded-2xl p-8 shadow-lg text-white">
            <h3 class="text-2xl font-bold mb-2">Konfirmasi Transfer</h3>
            <p class="text-green-100 text-sm mb-6 max-w-lg mx-auto">Untuk keperluan administrasi dan pencatatan kas masjid, mohon konfirmasikan infaq Anda beserta bukti transfer melalui WhatsApp kami.</p>
            
            <a href="https://wa.me/6281216978686?text=Assalamualaikum,%20saya%20ingin%20mengkonfirmasi%20infaq%20via%20QRIS/Transfer%20dengan%20nominal:%20[Isi%20Nominal]%20Berikut%20bukti%20transfernya." target="_blank" class="inline-flex items-center justify-center gap-2 bg-white text-green-800 hover:bg-gray-100 px-8 py-4 rounded-full font-bold transition-transform hover:scale-105 shadow-xl">
                <i class="fa-brands fa-whatsapp text-2xl text-green-500"></i>
                Konfirmasi via WhatsApp
            </a>
        </div>

    </main>

    @include('footer')

</body>
</html>