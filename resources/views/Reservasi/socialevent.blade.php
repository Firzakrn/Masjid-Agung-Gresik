<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Social Event - Masjid Agung Gresik</title>
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
        <p class="text-2xl md:text-3xl text-green-800/80 mb-4 tracking-wide">
            ⋄ ALL START FROM 7.500k ⋄ 
        </p>
        <div class="h-1 w-12 bg-green-200 mx-auto rounded-full"></div>
    </div>

    <div class="w-full flex flex-col">

        {{-- PAKET WORKSHOP --}}
        <section x-data="{ 
            active: 0, 
            images: ['{{ asset('images/reservasi/work.jpg') }}', '{{ asset('images/reservasi/work2.jpg') }}', '{{ asset('images/reservasi/work3.jpg') }}'],
            init() { setInterval(() => { this.active = (this.active + 1) % this.images.length; }, 3500); }
            }" class="grid grid-cols-1 md:grid-cols-2 w-full min-h-[500px]">
            
            <div class="flex flex-col justify-center px-8 md:pl-12 lg:pl-24 xl:pl-40 py-16">
                <span class="text-green-600 font-bold text-sm tracking-[0.2em] uppercase mb-4 block">Aula Utama</span>
                <h2 class="text-5xl md:text-6xl font-extrabold text-slate-900 mb-8 leading-tight">Workshop<br>Pelatihan</h2>
                
                <div class="flex gap-10 mb-10 text-slate-600">
                    <ul class="space-y-2 text-sm font-semibold">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 100 Kursi</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 2 Meja Tamu</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 2 Sound System</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 1 Sound Man</li>
                    </ul>
                    <ul class="space-y-2 text-sm font-semibold">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Wifi</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 2 LCD Proyektor</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Podium</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Ruangan ber AC</li>
                    </ul>
                </div>

                <div class="flex items-center gap-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Harga Sewa</p>
                        <p class="text-3xl font-extrabold text-slate-900">Rp 7.500.000</p>
                    </div>
                    @auth
                        <a href="{{ route('reservasi.tgl', ['paket' => 'Workshop']) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-md active:scale-95">
                            Pilih Paket
                        </a>
                    @else
                        <a href="{{ route('login') }}?redirect={{ urlencode(route('reservasi.tgl', ['paket' => 'Workshop'])) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-md active:scale-95">
                            Pilih Paket
                        </a>
                    @endauth
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

        {{-- PAKET WISUDA --}}
        <section x-data="{ 
            active: 0, 
            images: ['{{ asset('images/reservasi/wisuda.jpg') }}', '{{ asset('images/reservasi/wisuda2.jpg') }}', '{{ asset('images/reservasi/wisuda3.jpg') }}'],
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
                <span class="text-green-600 font-bold text-sm tracking-[0.2em] uppercase mb-4 block">Aula Utama</span>
                <h2 class="text-5xl md:text-6xl font-extrabold text-slate-900 mb-8 leading-tight">Wisuda</h2>
                
                <div class="flex gap-10 mb-10 text-slate-600 justify-end w-full">
                    <ul class="space-y-2 text-sm font-semibold text-left md:text-right">
                        <li class="flex items-center justify-start md:justify-end gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full md:hidden"></span> 100 Kursi <span class="hidden md:inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span></li>
                        <li class="flex items-center justify-start md:justify-end gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full md:hidden"></span> 2 Meja Tamu <span class="hidden md:inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span></li>
                        <li class="flex items-center justify-start md:justify-end gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full md:hidden"></span> 2 LCD Proyektor <span class="hidden md:inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span></li>
                    </ul>
                    <ul class="space-y-2 text-sm font-semibold text-left md:text-right">
                        <li class="flex items-center justify-start md:justify-end gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full md:hidden"></span> 1 Sound Man <span class="hidden md:inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span></li>
                        <li class="flex items-center justify-start md:justify-end gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full md:hidden"></span> 2 Sound System <span class="hidden md:inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span></li>
                        <li class="flex items-center justify-start md:justify-end gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full md:hidden"></span> Podium & Ruang VIP <span class="hidden md:inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span></li>
                        <li class="flex items-center justify-start md:justify-end gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full md:hidden"></span> Wifi & AC <span class="hidden md:inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span></li>
                    </ul>
                </div>

                <div class="flex flex-row-reverse items-center gap-6 justify-end">
                    @auth
                        <a href="{{ route('reservasi.tgl', ['paket' => 'Wisuda']) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-md active:scale-95">
                            Pilih Paket
                        </a>
                    @else
                        <a href="{{ route('login') }}?redirect={{ urlencode(route('reservasi.tgl', ['paket' => 'Wisuda'])) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-md active:scale-95">
                            Pilih Paket
                        </a>
                    @endauth
                    <div class="text-left md:text-right">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Biaya Sewa</p>
                        <p class="text-3xl font-extrabold text-slate-900">Rp 7.500.000</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- PAKET MAJELIS TAKLIM --}}
        <section x-data="{ 
            active: 0, 
            images: ['{{ asset('images/reservasi/majlis.jpg') }}', '{{ asset('images/reservasi/majlis1.png') }}', '{{ asset('images/reservasi/majlis2.jpg') }}'],
            init() { setInterval(() => { this.active = (this.active + 1) % this.images.length; }, 3500); }
        }" class="grid grid-cols-1 md:grid-cols-2 w-full min-h-[500px]">
            
            <div class="flex flex-col justify-center px-8 md:pl-12 lg:pl-24 xl:pl-40 py-16">
                <span class="text-green-600 font-bold text-sm tracking-[0.2em] uppercase mb-4 block">Aula Utama</span>
                <h2 class="text-5xl md:text-6xl font-extrabold text-slate-900 mb-8 leading-tight">Majelis <br>Taklim</h2>
                
                <div class="flex gap-10 mb-10 text-slate-600">
                    <ul class="space-y-2 text-sm font-semibold">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 100 Kursi</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 2 Meja Terima Tamu</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Podium & Ruang VIP</li>
                    </ul>
                    <ul class="space-y-2 text-sm font-semibold">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 2 Sound System</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 1 Sound Man</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> 2 LCD Proyektor</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> AC & Wifi</li>
                    </ul>
                </div>

                <div class="flex items-center gap-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Biaya Sewa</p>
                        <p class="text-3xl font-extrabold text-slate-900">Rp 7.500.000</p>
                    </div>
                    @auth
                        <a href="{{ route('reservasi.tgl', ['paket' => 'Majelis']) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-md active:scale-95">
                            Pilih Paket
                        </a>
                    @else
                        <a href="{{ route('login') }}?redirect={{ urlencode(route('reservasi.tgl', ['paket' => 'Majelis'])) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-md active:scale-95">
                            Pilih Paket
                        </a>
                    @endauth
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

</body>
</html>