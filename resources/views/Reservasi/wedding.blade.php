<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Gedung - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&family=Amiri&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-arabic { font-family: 'Amiri', serif; }
        .mask-to-left {
            mask-image: linear-gradient(to left, black 70%, transparent 100%);
            -webkit-mask-image: linear-gradient(to left, black 70%, transparent 100%);
        }
        .mask-to-right {
            mask-image: linear-gradient(to right, black 70%, transparent 100%);
            -webkit-mask-image: linear-gradient(to right, black 70%, transparent 100%);
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-white text-slate-900 overflow-x-hidden" x-data="{ showModal: false, selectedPackage: '' }" :class="showModal ? 'overflow-hidden' : ''">

    @include('navbar')

    <div class="pt-20 pb-16 text-center">
        <p class="text-2xl md:text-3xl text-green-800/80 font-arabic mb-4 tracking-wide">
            بَارَكَ اللهُ لَكُمَا وَبَارَكَ عَلَيْكُمَا وَجَمَعَ بَيْنَكُمَا فِي خَيْرٍ
        </p>
        <p class="py-4 text-xs font-bold text-slate-400 tracking-widest">"Semoga Allah memberkahimu dan memberkahi atasmu serta mengumpulkan kamu berdua dalam kebaikan"</p>
        <div class="h-1 w-12 bg-green-200 mx-auto rounded-full"></div>
    </div>

    <div class="w-full flex flex-col">

        {{-- PAKET WEDDING HALL --}}
        <section x-data="{ 
            active: 0, 
            images: ['{{ asset('images/reservasi/wedhall.jpg') }}', '{{ asset('images/reservasi/wedhall2.jpg') }}', '{{ asset('images/reservasi/wedhall3.jpg') }}'],
            init() { setInterval(() => { this.active = (this.active + 1) % this.images.length; }, 3500); }
            }" class="grid grid-cols-1 md:grid-cols-2 w-full min-h-[500px]">
            
            <div class="flex flex-col justify-center px-8 md:pl-12 lg:pl-24 xl:pl-40 py-16">
                <span class="text-green-600 font-bold text-sm tracking-[0.2em] uppercase mb-4 block">Aula Utama</span>
                <h2 class="text-5xl md:text-6xl font-extrabold text-slate-900 mb-8 leading-tight">Wedding <br>Hall</h2>
                
                <div class="flex gap-10 mb-10 text-slate-600">
                    <ul class="space-y-2 text-sm font-semibold">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 100 Kursi</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 2 Meja Tamu</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 2 Sound System</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 1 Sound Man</li>
                    </ul>
                    <ul class="space-y-2 text-sm font-semibold">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 6 AC Standing</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 3 AC Split</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Ruang VIP & Wifi</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Ruang Makeup</li>
                    </ul>
                </div>

                <div class="flex items-center gap-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Investment</p>
                        <p class="text-3xl font-extrabold text-slate-900">Rp 12.500.000</p>
                    </div>
                        <a href="{{ route('reservasi.tgl', ['paket' => 'Wedding']) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-md active:scale-95">
                            Pilih Paket
                        </a>
                </div>
            </div>

            <div class="relative w-full h-[400px] md:h-full overflow-hidden mask-to-left bg-slate-100">
                <div class="flex h-full w-full transition-transform duration-1000 ease-in-out" :style="`transform: translateX(-${active * 100}%)`">
                    <template x-for="(img, index) in images" :key="index">
                        <div class="w-full h-full flex-shrink-0">
                            <img :src="img" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>
            </div>
        </section>

        {{-- PAKET INTIMATE WEDDING --}}
        <section x-data="{ 
            active: 0, 
            images: ['{{ asset('images/reservasi/wedint.jpg') }}', '{{ asset('images/reservasi/wedint2.jpg') }}', '{{ asset('images/reservasi/wedint3.jpg') }}'],
            init() { setInterval(() => { this.active = (this.active + 1) % this.images.length; }, 3500); }
        }" class="grid grid-cols-1 md:grid-cols-2 w-full min-h-[500px]">
            
            <div class="relative w-full h-[400px] md:h-full overflow-hidden mask-to-right bg-slate-100 order-2 md:order-1">
                <div class="flex h-full w-full transition-transform duration-1000 ease-in-out" :style="`transform: translateX(-${active * 100}%)`">
                    <template x-for="(img, index) in images" :key="index">
                        <div class="w-full h-full flex-shrink-0">
                            <img :src="img" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>
            </div>

            <div class="flex flex-col justify-center items-start md:items-end text-left md:text-right px-8 md:pr-12 lg:pr-24 xl:pr-40 py-16 order-1 md:order-2">
                <span class="text-green-600 font-bold text-sm tracking-[0.2em] uppercase mb-4 block">MASJID LT 2</span>
                <h2 class="text-5xl md:text-6xl font-extrabold text-slate-900 mb-8 leading-tight">Intimate <br>Wedding</h2>
                
                <div class="flex gap-10 mb-10 text-slate-600 justify-end w-full">
                    <ul class="space-y-2 text-sm font-semibold text-left md:text-right">
                        <li class="flex items-center justify-start md:justify-end gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full md:hidden"></span> 50 Kursi <span class="hidden md:inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span></li>
                        <li class="flex items-center justify-start md:justify-end gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full md:hidden"></span> 2 Meja Tamu <span class="hidden md:inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span></li>
                    </ul>
                    <ul class="space-y-2 text-sm font-semibold text-left md:text-right">
                        <li class="flex items-center justify-start md:justify-end gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full md:hidden"></span> 1 Meja (200x50 cm) <span class="hidden md:inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span></li>
                        <li class="flex items-center justify-start md:justify-end gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full md:hidden"></span> Sound System & AC & Wifi <span class="hidden md:inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span></li>
                    </ul>
                </div>

                <div class="flex flex-row-reverse items-center gap-6 justify-end">
                        <a href="{{ route('reservasi.tgl', ['paket' => 'Intimate Wedding']) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-md active:scale-95">
                            Pilih Paket
                        </a>
                    <div class="text-left md:text-right">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Investment</p>
                        <p class="text-3xl font-extrabold text-slate-900">Rp 2.500.000</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- PAKET AKAD NIKAH --}}
        <section x-data="{ 
            active: 0, 
            images: ['{{ asset('images/reservasi/akad.jpg') }}', '{{ asset('images/reservasi/akad2.jpg') }}', '{{ asset('images/reservasi/akad3.jpg') }}'],
            init() { setInterval(() => { this.active = (this.active + 1) % this.images.length; }, 3500); }
        }" class="grid grid-cols-1 md:grid-cols-2 w-full min-h-[500px]">
            
            <div class="flex flex-col justify-center px-8 md:pl-12 lg:pl-24 xl:pl-40 py-16">
                <span class="text-green-600 font-bold text-sm tracking-[0.2em] uppercase mb-4 block">Masjid Lt 2</span>
                <h2 class="text-5xl md:text-6xl font-extrabold text-slate-900 mb-8 leading-tight">Akad <br>Nikah</h2>
                
                <div class="flex gap-10 mb-10 text-slate-600">
                    <ul class="space-y-2 text-sm font-semibold">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> MC Akad Nikah</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 1 Set Meja Prosesi</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Khutbah Nikah</li>
                    </ul>
                    <ul class="space-y-2 text-sm font-semibold">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Qori Akad Nikah</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Sound System & Wifi</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Durasi 1.5 Jam</li>
                    </ul>
                </div>

                <div class="flex items-center gap-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Investment</p>
                        <p class="text-3xl font-extrabold text-slate-900">Rp 3.000.000</p>
                    </div>
                        <a href="{{ route('reservasi.tgl', ['paket' => 'Akad Nikah']) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-md active:scale-95">
                            Pilih Paket
                        </a>
                </div>
            </div>

            <div class="relative w-full h-[400px] md:h-full overflow-hidden mask-to-left bg-slate-100">
                <div class="flex h-full w-full transition-transform duration-1000 ease-in-out" :style="`transform: translateX(-${active * 100}%)`">
                    <template x-for="(img, index) in images" :key="index">
                        <div class="w-full h-full flex-shrink-0">
                            <img :src="img" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>
            </div>
        </section>

    </div>

    <div class="max-w-7xl mx-auto px-8 pb-12 mt-12">
        <hr class="border-t-2 border-green-500 mb-8 opacity-50">
        
        <div class="flex flex-row justify-between items-center gap-8">
            <div class="flex items-center gap-4 md:gap-6">
                <span class="hidden md:block text-xs font-bold text-slate-400 uppercase tracking-widest">Further Contact</span>
                <a href="https://wa.me/6281216978686" target="_blank" rel="noopener noreferrer" class="hover:scale-110 transition-transform duration-300">
                    <div class="w-10 h-10 bg-green-50 border border-green-100 rounded-full flex items-center justify-center shadow-sm hover:shadow-md transition">
                        <img src="https://www.google.com/s2/favicons?domain=wa.me&sz=64" alt="WhatsApp" class="w-5 h-5">
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-4 md:gap-6">
                <span class="hidden md:block text-xs font-bold text-slate-400 uppercase tracking-widest">Other Wedding Organizer</span>
                <div class="flex gap-4">
                    <a href="https://pernikahan.or.id/?s=masjid+agung+gresik" target="_blank" rel="noopener noreferrer" title="Pernikahan.or.id" class="hover:scale-110 transition-transform duration-300">
                        <div class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center shadow-sm hover:shadow-md transition overflow-hidden">
                            <img src="https://www.google.com/s2/favicons?domain=pernikahan.or.id&sz=64" alt="Pernikahan.or.id" class="w-6 h-6">
                        </div>
                    </a>
                    <a href="https://jagarasa.com/product/paket-wedding-di-masjid-agung-gresik/" target="_blank" rel="noopener noreferrer" title="Jagarasa Wedding Organizer" class="hover:scale-110 transition-transform duration-300">
                        <div class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center shadow-sm hover:shadow-md transition overflow-hidden">
                            <img src="https://www.google.com/s2/favicons?domain=jagarasa.com&sz=64" alt="Jagarasa" class="w-6 h-6">
                        </div>
                    </a>
                    <a href="https://cateringku.com/area/gresik/all-in/" target="_blank" rel="noopener noreferrer" title="Cateringku Gresik" class="hover:scale-110 transition-transform duration-300">
                        <div class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center shadow-sm hover:shadow-md transition overflow-hidden">
                            <img src="https://www.google.com/s2/favicons?domain=cateringku.com&sz=64" alt="Cateringku" class="w-6 h-6">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>