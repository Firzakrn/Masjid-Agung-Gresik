<!-- ================= MODAL SLIDE UP (FULL SCREEN) ================= -->
    
<!-- Latar Belakang Gelap (Overlay) -->
<div x-show="isZisModalOpen" 
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-slate-900/80 z-[100] backdrop-blur-md"
     @click="closeModal()">
</div>

<!-- Kontainer Modal -->
<div x-show="isZisModalOpen" 
     x-cloak
     x-transition:enter="transition ease-out duration-500 transform"
     x-transition:enter-start="translate-y-full"
     x-transition:enter-end="translate-y-0"
     x-transition:leave="transition ease-in duration-300 transform"
     x-transition:leave-start="translate-y-0"
     x-transition:leave-end="translate-y-full"
     class="fixed inset-x-0 bottom-0 top-0 md:top-10 z-[110] bg-slate-50 md:rounded-t-[2.5rem] shadow-2xl flex flex-col overflow-hidden max-w-7xl mx-auto w-full">
    
    <!-- HEADER MODAL & TOMBOL CLOSE -->
    <div class="bg-white px-6 py-4 border-b border-slate-200 flex justify-between items-center z-[120] shadow-sm relative">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-hand-holding-dollar"></i>
            </div>
            <h2 class="text-xl font-extrabold text-slate-800">Formulir Zakat & Infaq</h2>
        </div>
        <button @click="closeModal()" class="w-10 h-10 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center hover:bg-red-100 hover:text-red-600 transition">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
    </div>

    <!-- AREA SCROLL FORM (Isi Konten) -->
    <div class="overflow-y-auto flex-1 pb-10">
        
        <!-- Header Visual ZIS -->
        <div class="text-center bg-green-700 pt-10 pb-16 relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-10"></div>
            <h1 class="text-4xl font-bold text-white mb-3 relative z-10">Infaq & Sedekah</h1>
            <p class="text-green-100 relative z-10 px-4">Mari sucikan harta dan raih pahala jariyah dengan berinfaq untuk kemakmuran Masjid Agung Gresik.</p>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 -mt-10 relative z-20">
            <!-- Kotak QRIS Utama -->
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8 md:p-12 text-center mb-10 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-green-400 to-green-700"></div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">Scan QRIS</h2>
                
                <div class="flex justify-center mb-6">
                    <div class="p-4 border-4 border-green-100 rounded-2xl shadow-sm inline-block bg-white">
                        <img src="{{ asset('images/qris.jpeg') }}" alt="QRIS Masjid Agung Gresik" class="w-full max-w-[250px] md:max-w-[350px] object-contain rounded-xl">
                    </div>
                </div>

                <a href="{{ asset('images/infaq.jpeg') }}" download="QRIS_Masjid_Agung_Gresik.jpeg" class="inline-flex items-center justify-center gap-2 bg-green-50 text-green-700 hover:bg-green-100 px-6 py-3 rounded-full font-semibold transition-colors duration-300 mb-2 text-sm border border-green-200">
                    <i class="fa-solid fa-download"></i> Simpan Gambar QRIS
                </a>
            </div>

            <!-- Cara Berinfaq -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-10">
                <h3 class="text-xl font-bold text-green-800 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-green-500"></i> Cara Berinfaq via QRIS
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200">1</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Buka Aplikasi</h4>
                            <p class="text-sm text-gray-600 mt-1">Buka aplikasi Mobile Banking atau E-Wallet (GoPay, OVO, DANA, ShopeePay).</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200">2</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Pilih Menu Scan</h4>
                            <p class="text-sm text-gray-600 mt-1">Pilih menu Scan QR. Arahkan kamera ke gambar QRIS di atas, atau pilih dari galeri.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200">3</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Masukkan Nominal</h4>
                            <p class="text-sm text-gray-600 mt-1">Masukkan nominal infaq. Pastikan nama penerima <strong>Masjid Agung Gresik</strong>.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200">4</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Selesaikan</h4>
                            <p class="text-sm text-gray-600 mt-1">Masukkan PIN aplikasi Anda. Jangan lupa simpan bukti transfer.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Konfirmasi -->
            <div class="text-center bg-green-800 rounded-2xl p-8 shadow-lg text-white">
                <h3 class="text-2xl font-bold mb-2">Konfirmasi Transfer</h3>
                <p class="text-green-100 text-sm mb-6 max-w-lg mx-auto">Mohon konfirmasikan infaq Anda beserta bukti transfer melalui WhatsApp kami.</p>
                
                <a href="https://wa.me/6281216978686?text=Assalamualaikum,%20saya%20ingin%20mengkonfirmasi%20infaq%20via%20QRIS/Transfer.%20Berikut%20bukti%20transfernya." target="_blank" class="inline-flex items-center justify-center gap-2 bg-white text-green-800 hover:bg-gray-100 px-8 py-4 rounded-full font-bold transition-transform hover:scale-105 shadow-xl">
                    <i class="fa-brands fa-whatsapp text-2xl text-green-500"></i>
                    Konfirmasi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>