<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Gedung Pernikahan - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .carousel-item {
            scroll-snap-align: center;
            transition: all 0.3s ease;
        }
        .carousel-active {
            opacity: 1;
            transform: scale(1);
        }
        .carousel-inactive {
            opacity: 0.5; 
            transform: scale(0.95);
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;  
            scrollbar-width: none;  
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800" x-data="{ showFacilities: false, selectedPackage: '' }">

    @include('navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <h1 class="text-4xl md:text-5xl font-extrabold text-center text-gray-900 mb-6">Pilih Paket Reservasi</h1>
        <p class="text-xl text-center text-gray-600 mb-16 max-w-2xl mx-auto">Masjid Agung Gresik menyediakan berbagai pilihan paket gedung dan tempat akad nikah yang sakral dan representatif.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            <div x-data="{ activeImage: 0, images: ['{{ asset('images/reservasi/wedhal.jpg') }}', '{{ asset('images/reservasi/wedhal_carousel2.jpg') }}', '{{ asset('images/reservasi/wedhal_carousel3.jpg') }}'] }" 
                 class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden group transition hover:shadow-2xl">
                
                <div class="relative overflow-hidden pt-4 px-4 h-64">
                    <div class="flex items-center space-x-3 overflow-x-auto no-scrollbar scroll-smooth h-full" x-ref="carousel">
                        <template x-for="(image, index) in images" :key="index">
                            <div class="flex-none w-4/5 h-full carousel-item rounded-xl overflow-hidden"
                                 :class="activeImage === index ? 'carousel-active' : 'carousel-inactive'">
                                <img :src="image" alt="Wedding Hall Gallery" class="w-full h-full object-cover">
                            </div>
                        </template>
                    </div>
                    <button @click="activeImage = (activeImage > 0 ? activeImage - 1 : images.length - 1); $refs.carousel.scrollLeft = ($refs.carousel.offsetWidth * 0.8) * activeImage" 
                            class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/70 p-2 rounded-full text-green-700 hover:bg-white shadow">
                        &larr;
                    </button>
                    <button @click="activeImage = (activeImage < images.length - 1 ? activeImage + 1 : 0); $refs.carousel.scrollLeft = ($refs.carousel.offsetWidth * 0.8) * activeImage" 
                            class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/70 p-2 rounded-full text-green-700 hover:bg-white shadow">
                        &rarr;
                    </button>
                </div>

                <div class="p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">WEDDING HALL</h2>
                    <ul class="space-y-3.5 text-gray-700 mb-10 text-base">
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>100 Kursi</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>2 Meja Terima tamu</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>2 set Sound System</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>1 Sound man</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Ruang VIP</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Ruang Make Up</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>WIFI</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>AC</li>
                    </ul>
                    <div class="text-4xl font-extrabold text-green-700 mb-8 border-t border-gray-100 pt-6">12.500.000 <span class="text-xl text-gray-500 font-medium">/paket</span></div>
                    <a href="#section-reservasi" 
                       @click="showFacilities = true; selectedPackage = 'Wedding Hall (12.5Juta)'" 
                       class="block text-center w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl shadow-lg transition duration-300">
                        Pilih Paket & Reservasi
                    </a>
                </div>
            </div>

            <div x-data="{ activeImage: 0, images: ['{{ asset('images/reservasi/wedint.jpg') }}', '{{ asset('images/reservasi/wedint_carousel2.jpg') }}', '{{ asset('images/reservasi/wedint_carousel3.jpg') }}'] }" 
                 class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden group transition hover:shadow-2xl">
                
                <div class="relative overflow-hidden pt-4 px-4 h-64">
                    <div class="flex items-center space-x-3 overflow-x-auto no-scrollbar scroll-smooth h-full" x-ref="carousel">
                        <template x-for="(image, index) in images" :key="index">
                            <div class="flex-none w-4/5 h-full carousel-item rounded-xl overflow-hidden"
                                 :class="activeImage === index ? 'carousel-active' : 'carousel-inactive'">
                                <img :src="image" alt="Intimate Wedding Gallery" class="w-full h-full object-cover">
                            </div>
                        </template>
                    </div>
                    <button @click="activeImage = (activeImage > 0 ? activeImage - 1 : images.length - 1); $refs.carousel.scrollLeft = ($refs.carousel.offsetWidth * 0.8) * activeImage" class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/70 p-2 rounded-full shadow">&larr;</button>
                    <button @click="activeImage = (activeImage < images.length - 1 ? activeImage + 1 : 0); $refs.carousel.scrollLeft = ($refs.carousel.offsetWidth * 0.8) * activeImage" class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/70 p-2 rounded-full shadow">&rarr;</button>
                </div>

                <div class="p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">INTIMATE WEDDING</h2>
                    <ul class="space-y-3.5 text-gray-700 mb-10 text-base">
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>50 Kursi</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>2 Meja Terima tamu</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>1 Meja (200x50 cm)</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Sound System</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>AC</li>
                    </ul>
                    <div class="text-4xl font-extrabold text-green-700 mb-8 border-t border-gray-100 pt-6">2.500.000 <span class="text-xl text-gray-500 font-medium">/paket</span></div>
                    <a href="#section-reservasi" 
                       @click="showFacilities = true; selectedPackage = 'Intimate Wedding (2.5Juta)'" 
                       class="block text-center w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl shadow-lg transition duration-300">
                        Pilih Paket & Reservasi
                    </a>
                </div>
            </div>

            <div x-data="{ activeImage: 0, images: ['{{ asset('images/reservasi/akad.jpg') }}', '{{ asset('images/reservasi/akad_carousel2.jpg') }}', '{{ asset('images/reservasi/akad_carousel3.jpg') }}'] }" 
                 class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden group transition hover:shadow-2xl hover:-translate-y-1 hover:border-green-100">
                
                <div class="relative overflow-hidden pt-4 px-4 h-64">
                    <div class="flex items-center space-x-3 overflow-x-auto no-scrollbar scroll-smooth h-full" x-ref="carousel">
                        <template x-for="(image, index) in images" :key="index">
                            <div class="flex-none w-4/5 h-full carousel-item rounded-xl overflow-hidden"
                                 :class="activeImage === index ? 'carousel-active' : 'carousel-inactive'">
                                <img :src="image" alt="Akad Nikah Gallery" class="w-full h-full object-cover">
                            </div>
                        </template>
                    </div>
                    <button @click="activeImage = (activeImage > 0 ? activeImage - 1 : images.length - 1); $refs.carousel.scrollLeft = ($refs.carousel.offsetWidth * 0.8) * activeImage" class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/70 p-2 rounded-full shadow">&larr;</button>
                    <button @click="activeImage = (activeImage < images.length - 1 ? activeImage + 1 : 0); $refs.carousel.scrollLeft = ($refs.carousel.offsetWidth * 0.8) * activeImage" class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/70 p-2 rounded-full shadow">&rarr;</button>
                </div>

                <div class="p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">AKAD NIKAH <span class="text-xl block text-gray-600 mt-1">MASJID LT 2</span></h2>
                    <ul class="space-y-3.5 text-gray-700 mb-10 text-base">
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>MC Akad Nikah</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Khutbah Nikah</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Qori Akad Nikah</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>1 set Meja Prosesi</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Sound System</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Durasi 1.5 jam</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✔</span>Wifi</li>
                    </ul>
                    <div class="text-4xl font-extrabold text-green-700 mb-8 border-t border-gray-100 pt-6">3.000.000 <span class="text-xl text-gray-500 font-medium">/paket</span></div>
                    <a href="#section-reservasi" 
                       @click="showFacilities = true; selectedPackage = 'Akad Nikah Masjid (3Juta)'" 
                       class="block text-center w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl shadow-lg transition duration-300">
                        Pilih Paket & Reservasi
                    </a>
                </div>
            </div>

        </div>

        <div class="mt-16 text-center border-2 border-dashed border-gray-200 bg-gray-100 rounded-3xl p-10 max-w-xl mx-auto">
            <h4 class="text-2xl font-bold mb-4">Butuh Konsultasi Kustom?</h4>
            <p class="text-lg text-gray-600 mb-6">Jangan ragu menghubungi tim kami untuk menyesuaikan kebutuhan acara sakral Anda.</p>
            <a href="https://wa.me/628123456789" target="_blank" class="inline-flex items-center text-3xl font-bold text-green-700 hover:text-green-800 bg-green-100 px-6 py-3 rounded-2xl shadow-inner">
                <svg class="h-8 w-8 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12.012 2c-5.522 0-9.997 4.477-9.997 9.998 0 1.763.459 3.42 1.258 4.858L2 22l5.314-1.396a9.97 9.97 0 0 0 4.698 1.169C17.534 21.773 22 17.296 22 11.775s-4.466-9.775-9.988-9.775zm.012 17.54c-1.607 0-3.12-.416-4.43-1.14l-.317-.184-3.293.866.88-3.21-.202-.323a8.395 8.395 0 0 1-1.248-4.381c0-4.63 3.767-8.398 8.4-8.398s8.398 3.767 8.398 8.4-3.767 8.4-8.398 8.4-.002-.002 0 0z"/><path d="M17.13 14.399c-.282-.141-1.666-.823-1.923-.918-.258-.094-.446-.141-.634.141-.188.281-.727.918-.891 1.109-.164.187-.328.211-.61.071-.281-.141-1.189-.438-2.264-1.399-.838-.747-1.403-1.67-1.567-1.952-.164-.281-.017-.433.123-.572.127-.127.282-.329.422-.493.142-.164.188-.282.282-.47.094-.187.047-.352-.023-.493-.07-.141-.634-1.528-.868-2.09-.235-.562-.469-.492-.634-.492-.164-.005-.352-.005-.539-.005s-.492.07-.75.352c-.258.281-.984.962-.984 2.345s1.007 2.719 1.148 2.906c.141.188 1.984 3.03 4.809 4.246.671.289 1.196.462 1.604.59.674.215 1.287.185 1.771.113.541-.082 1.666-.681 1.9-.1.339.234.339.609.613.069.28.069z"/></svg>
                +62 812-3456-789
            </a>
        </div>

    </div>

    <div id="section-reservasi" class="bg-gray-100 border-t border-gray-200 mt-24 py-20" 
         x-show="showFacilities" 
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-12"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         style="display: none;">
        
        <div class="max-w-4xl mx-auto px-6">
            <h3 class="text-4xl font-extrabold text-gray-900 mb-3">Lengkapi Data Reservasi</h3>
            <p class="text-lg text-gray-600 mb-12">Silakan isi formulir di bawah ini. Paket yang Anda pilih: <strong class="text-green-700 font-bold" x-text="selectedPackage"></strong></p>
            
            <form action="{{ route('reservasi.submit') }}" method="POST" class="space-y-8 bg-white p-10 rounded-3xl shadow-lg border border-gray-100">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap Sesuai KTP</label>
                        <input type="text" id="nama" name="nama" required class="w-full px-5 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-500 transition">
                    </div>
                    <div>
                        <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">No HP (WhatsApp Aktif)</label>
                        <input type="tel" id="no_hp" name="no_hp" required class="w-full px-5 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-500 transition">
                    </div>
                    <div>
                        <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Acara</label>
                        <input type="date" id="tanggal" name="tanggal" required class="w-full px-5 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-500 transition">
                    </div>
                    <div>
                        <label for="jam" class="block text-sm font-semibold text-gray-700 mb-2">Perkiraan Jam Acara</label>
                        <input type="time" id="jam" name="jam" required class="w-full px-5 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-500 transition">
                    </div>
                </div>

                <div class="mt-12 pt-10 border-t border-gray-100">
                    <h4 class="text-2xl font-bold mb-3">FASILITAS TAMBAHAN</h4>
                    <p class="text-gray-600 mb-8">Centang dan isi jumlah (pcs/roll/set) untuk fasilitas tambahan yang Anda perlukan. Biaya akan ditambahkan kemudian.</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-6">
                        
                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="kursi_banquet" class="text-gray-700 text-base">Kursi Banquet <span class="text-xs text-gray-400 block mt-0.5">5.000/pcs</span></label>
                            <input type="number" id="kursi_banquet" name="fasilitas[kursi_banquet]" placeholder="Pcs" class="w-24 px-4 py-2 border border-gray-100 rounded-lg text-sm focus:ring-1 focus:ring-green-300 transition">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="cover_kursi_banquet" class="text-gray-700 text-base">Cover Kursi Banquet <span class="text-xs text-gray-400 block mt-0.5">7.500/pcs</span></label>
                            <input type="number" id="cover_kursi_banquet" name="fasilitas[cover_kursi_banquet]" placeholder="Pcs" class="w-24 px-4 py-2 border border-gray-100 rounded-lg text-sm focus:ring-1 focus:ring-green-300 transition">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="shofa" class="text-gray-700 text-base">Shofa <span class="text-xs text-gray-400 block mt-0.5">100.000/pcs</span></label>
                            <input type="number" id="shofa" name="fasilitas[shofa]" placeholder="Pcs" class="w-24 px-4 py-2 border border-gray-100 rounded-lg text-sm focus:ring-1 focus:ring-green-300 transition">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="shofa_lantai" class="text-gray-700 text-base">Shofa lantai <span class="text-xs text-gray-400 block mt-0.5">100.000/pcs</span></label>
                            <input type="number" id="shofa_lantai" name="fasilitas[shofa_lantai]" placeholder="Pcs" class="w-24 px-4 py-2 border border-gray-100 rounded-lg text-sm focus:ring-1 focus:ring-green-300 transition">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="meja_tamu_vip" class="text-gray-700 text-base">Meja Tamu VIP <span class="text-xs text-gray-400 block mt-0.5">50.000/pcs</span></label>
                            <input type="number" id="meja_tamu_vip" name="fasilitas[meja_tamu_vip]" placeholder="Pcs" class="w-24 px-4 py-2 border border-gray-100 rounded-lg text-sm focus:ring-1 focus:ring-green-300 transition">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="karpet_panggung_full" class="text-gray-700 text-base">Karpet Panggung Full <span class="text-xs text-gray-400 block mt-0.5">300.000</span></label>
                            <input type="checkbox" id="karpet_panggung_full" name="fasilitas[karpet_panggung_full]" class="h-6 w-6 rounded border-gray-100 text-green-600 focus:ring-green-500">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="karpet_lantai_suci" class="text-gray-700 text-base">Karpet Lantai Suci <span class="text-xs text-gray-400 block mt-0.5">300.000/roll</span></label>
                            <input type="number" id="karpet_lantai_suci" name="fasilitas[karpet_lantai_suci]" placeholder="Roll" class="w-24 px-4 py-2 border border-gray-100 rounded-lg text-sm focus:ring-1 focus:ring-green-300 transition">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="perlengkapan_manasik" class="text-gray-700 text-base">Perlengkapan Manasik <span class="text-xs text-gray-400 block mt-0.5">500.000/set</span></label>
                            <input type="checkbox" id="perlengkapan_manasik" name="fasilitas[perlengkapan_manasik]" class="h-6 w-6 rounded border-gray-100 text-green-600 focus:ring-green-500">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="meja_terima_tamu" class="text-gray-700 text-base">Meja Terima Tamu (200x50 cm) <span class="text-xs text-gray-400 block mt-0.5">35.000/pcs</span></label>
                            <input type="number" id="meja_terima_tamu" name="fasilitas[meja_terima_tamu]" placeholder="Pcs" class="w-24 px-4 py-2 border border-gray-100 rounded-lg text-sm focus:ring-1 focus:ring-green-300 transition">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="kursi_lipat" class="text-gray-700 text-base">Kursi Lipat <span class="text-xs text-gray-400 block mt-0.5">2.500/pcs</span></label>
                            <input type="number" id="kursi_lipat" name="fasilitas[kursi_lipat]" placeholder="Pcs" class="w-24 px-4 py-2 border border-gray-100 rounded-lg text-sm focus:ring-1 focus:ring-green-300 transition">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="cover_kursi_lipat" class="text-gray-700 text-base">Cover Kursi Lipat <span class="text-xs text-gray-400 block mt-0.5">3.500/pcs</span></label>
                            <input type="number" id="cover_kursi_lipat" name="fasilitas[cover_kursi_lipat]" placeholder="Pcs" class="w-24 px-4 py-2 border border-gray-100 rounded-lg text-sm focus:ring-1 focus:ring-green-300 transition">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <label for="islamic_center" class="text-gray-700 text-base">Islamic Center <span class="text-xs text-gray-400 block mt-0.5">2.500.000</span></label>
                            <input type="checkbox" id="islamic_center" name="fasilitas[islamic_center]" class="h-6 w-6 rounded border-gray-100 text-green-600 focus:ring-green-500">
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-3 pb-3 col-span-1 sm:col-span-2">
                            <label for="ruang_vip" class="text-gray-700 text-base">Ruang VIP <span class="text-xs text-gray-400 block mt-0.5">1.000.000</span></label>
                            <input type="checkbox" id="ruang_vip" name="fasilitas[ruang_vip]" class="h-6 w-6 rounded border-gray-100 text-green-600 focus:ring-green-500">
                        </div>

                    </div>
                </div>

                <div class="pt-8">
                    <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-extrabold py-5 rounded-2xl text-xl shadow-lg transition duration-300 transform hover:scale-105 active:scale-95">
                        Ajukan Reservasi Sekarang
                    </button>
                    <p class="text-sm text-center text-gray-500 mt-4">Pihak masjid akan menghubungi Anda maksimal 2x24 jam untuk konfirmasi ketersediaan dan total biaya.</p>
                </div>

            </form>
        </div>
    </div>

</body>
</html>