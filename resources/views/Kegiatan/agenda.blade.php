<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Masjid - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .swiper-button-next, .swiper-button-prev {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            width: 50px !important;
            height: 50px !important;
            border-radius: 50%;
            color: white !important;
            transition: all 0.3s ease;
        }
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background-color: rgba(255, 255, 255, 0.4);
            transform: scale(1.1);
        }
        .swiper-button-next::after, .swiper-button-prev::after {
            font-size: 20px !important;
            font-weight: bold;
        }
        
        /* Custom Pagination */
        .swiper-pagination-bullet-active {
            background-color: #16a34a !important; 
            width: 24px !important;
            border-radius: 999px !important;
        }
        .swiper-pagination-bullet {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen text-slate-800">
    
    @include('navbar')
    
    <!-- HERO SECTION: HIGHLIGHT AGENDA -->
    <div class="w-full h-[500px] md:h-[600px] relative group">
        <div class="swiper heroSwiper w-full h-full">
            <div class="swiper-wrapper">

                <!-- PERULANGAN HIGHLIGHT AGENDA -->
                @foreach($heroAgenda as $item)
                <div class="swiper-slide relative flex items-end pb-20 md:pb-32 px-4 md:px-20 justify-start text-left overflow-hidden">
                    <img src="{{ $item->foto ? asset('images/berita/' . $item->foto) : 'https://images.unsplash.com/photo-1519817650390-64a93db51149?q=80&w=2000&auto=format&fit=crop' }}" class="absolute inset-0 w-full h-full object-cover" alt="{{ $item->judul }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>
                    
                    <div class="relative z-10 max-w-3xl transform transition-transform duration-700 translate-y-0">
                        <span class="inline-block px-4 py-1.5 bg-green-500/20 backdrop-blur-md text-green-300 border border-green-400/30 rounded-full text-sm font-bold tracking-widest uppercase mb-4 shadow-lg">
                            <i class="fa-solid fa-star mr-1"></i> Spesial Minggu Ini
                        </span>
                        <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-4 drop-shadow-md">{{ $item->judul }}</h1>
                        <p class="text-slate-200 text-lg md:text-xl mb-8 max-w-2xl line-clamp-2">{{ $item->isi_konten }}</p>
                        <a href="{{ route('kegiatan.detail', $item->id) }}" class="inline-flex items-center gap-2 px-8 py-4 bg-green-600 hover:bg-green-500 text-white font-bold rounded-2xl transition shadow-lg shadow-green-600/30">
                            Lihat Detail Acara <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
                
            </div>
            
            <div class="swiper-pagination mb-4"></div>
            <div class="swiper-button-next hidden md:flex opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="swiper-button-prev hidden md:flex opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>
    </div>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 py-16 w-full overflow-hidden relative -mt-10 z-10">
        
        <!-- SECTION: JADWAL RUTIN (GRID) -->
        <!-- Bagian ini aku biarkan statis sesuai kodemu karena sifatnya jadwal tetap -->
        <div class="pt-10 border-t border-slate-200">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-slate-800">Kajian & Majelis Rutin</h2>
                <p class="text-slate-500 mt-2">Hadirilah majelis ilmu yang diadakan secara rutin di Masjid Agung.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Rutinan 1 -->
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-start gap-4 hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center text-2xl flex-shrink-0">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-md mb-2 inline-block">Setiap Selasa</span>
                        <h4 class="font-bold text-slate-800 text-lg">Baca Rotibul Haddad</h4>
                        <p class="text-sm text-slate-500 mt-1">Ba'da Maghrib | Oleh Ust. Ahmad Humaidi S.Pd.I</p>
                    </div>
                </div>
                <!-- Rutinan 2 -->
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-start gap-4 hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl flex-shrink-0">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-md mb-2 inline-block">Jumat Berkah</span>
                        <h4 class="font-bold text-slate-800 text-lg">Nasi Kotak Gratis</h4>
                        <p class="text-sm text-slate-500 mt-1">Ba'da Sholat Subuh | Terbuka untuk umum</p>
                    </div>
                </div>
                <!-- Rutinan 3 -->
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-start gap-4 hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center text-2xl flex-shrink-0">
                        <i class="fa-solid fa-child-reaching"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-orange-600 bg-orange-50 px-2 py-1 rounded-md mb-2 inline-block">Ahad Diba'</span>
                        <h4 class="font-bold text-slate-800 text-lg">Baca Diba' Anak - anak </h4>
                        <p class="text-sm text-slate-500 mt-1">Ba'da Maghrib | Lantai 2</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION: POSTER AGENDA MENDATANG -->
        <div class="mb-20">
            <div class="text-center mb-12 mt-16">
                <h2 class="mb-4 text-3xl md:text-4xl font-extrabold text-slate-800">Agenda Mendatang</h2>
                <hr class="w-16 border-t-4 border-green-600 mx-auto mb-4">
            </div>
            
            <div class="swiper posterSwiper w-full !pb-12">
                <div class="swiper-wrapper">
                    
                    <!-- PERULANGAN KARTU AGENDA -->
                    @forelse($agendaPosters as $item)
                    <div class="swiper-slide h-auto">
                        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden h-full flex flex-col group cursor-pointer hover:shadow-xl transition-all duration-300">
                            <!-- Image wrapper -->
                            <div class="relative h-64 overflow-hidden"> 
                                <img src="{{ $item->foto ? asset('images/berita/' . $item->foto) : 'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?q=80&w=800&auto=format&fit=crop' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $item->judul }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                
                                <!-- Tanggal Bulan Otomatis dari Carbon -->
                                @if(!empty($item->waktu_acara))
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-center rounded-xl px-3 py-2 shadow-lg border border-white/50">
                                    <p class="text-xs font-bold text-slate-500 uppercase">{{ \Carbon\Carbon::parse($item->waktu_acara)->translatedFormat('M') }}</p>
                                    <p class="text-xl font-black text-green-600 leading-none">{{ \Carbon\Carbon::parse($item->waktu_acara)->format('d') }}</p>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Content -->
                            <div class="p-6 flex flex-col flex-grow">
                                @if(!empty($item->waktu_acara))
                                <div class="flex items-center gap-2 text-sm text-slate-500 mb-3 font-medium"> 
                                    <i class="fa-regular fa-clock text-green-600"></i> {{ \Carbon\Carbon::parse($item->waktu_acara)->format('H:i') }} WIB
                                </div>
                                @endif
                                
                                <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-green-600 transition-colors line-clamp-2">{{ $item->judul }}</h3>
                                <p class="text-slate-600 text-sm line-clamp-2 mb-6">{{ $item->isi_konten }}</p>
                                
                                <!-- Footer Card -->
                                <a href="{{ route('kegiatan.detail', $item->id) }}" class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between text-sm font-bold text-slate-400 group-hover:text-green-600 transition">
                                    <span>Lihat Selengkapnya</span>
                                    <i class="fa-solid fa-arrow-right transform group-hover:translate-x-2 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="w-full text-center py-10 col-span-full">
                        <i class="fa-regular fa-calendar-xmark text-5xl text-slate-300 mb-3"></i>
                        <p class="text-slate-500">Belum ada agenda mendatang yang dijadwalkan.</p>
                    </div>
                    @endforelse
                    
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Highlight Slider Setup
        new Swiper(".heroSwiper", {
            loop: true,
            effect: "fade", 
            fadeEffect: {           
                crossFade: true    
            },
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        });

        // Poster Slider Setup
        new Swiper(".posterSwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: { delay: 4000, disableOnInteraction: true },
            pagination: { el: ".swiper-pagination", clickable: true, dynamicBullets: true },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 3, spaceBetween: 30 },
            }
        });
    </script>
</body>
</html>