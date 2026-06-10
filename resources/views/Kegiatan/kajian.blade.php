<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kajian - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --hijau-kajian: #059669; 
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .swiper-pagination-bullet-active {
            background-color: var(--hijau-kajian) !important;
            width: 24px !important;
            border-radius: 999px !important;
        }
        .swiper-pagination-bullet {
            transition: all 0.3s ease;
        }
        
        .glass-badge {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen text-slate-800">
    
    @include('navbar')

    <!-- HIGHLIGHT KAJIAN -->
    <div class="w-full bg-gradient-to-br from-[#059669] to-emerald-400 py-16 md:py-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-emerald-900 opacity-20 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4"></div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10 text-center">
            <span class="glass-badge text-white px-4 py-1.5 rounded-full text-sm font-bold tracking-widest uppercase shadow-lg inline-block mb-4">
                <i class="fa-solid fa-book-open mr-1"></i> Majelis Ilmu
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-md">Kajian & Keilmuan</h1>
            <p class="text-emerald-50 text-lg max-w-2xl mx-auto opacity-90">Mari tingkatkan keimanan dan ketaqwaan melalui majelis ilmu yang rutin diselenggarakan di Masjid Agung Gresik.</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 py-16 w-full overflow-hidden -mt-8 relative z-20">
        
        <!-- ================= SECTION KAJIAN KITAB ================= -->
        <div class="mb-20">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-2 h-8 bg-[#059669] rounded-full"></div>
                <h2 class="text-3xl font-extrabold text-slate-800">Kajian Kitab</h2>
            </div>
            
            <div class="swiper kitabSwiper w-full !pb-12">
                <div class="swiper-wrapper">
                    
                    @forelse($kajianKitab as $item)
                        <div class="swiper-slide h-auto">
                            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden h-full flex flex-col group hover:shadow-xl transition-all duration-300">
                                
                                <div class="relative h-56 overflow-hidden bg-slate-200">
                                    <img src="{{ $item->foto ? asset('images/berita/' . $item->foto) : 'https://images.unsplash.com/photo-1609599006353-e629aaab31f5?q=80&w=1170&auto=format&fit=crop' }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                                         alt="{{ $item->judul }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    
                                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-center rounded-xl px-3 py-1.5 shadow-lg border border-white/50">
                                        <span class="text-xs font-extrabold text-emerald-600 uppercase tracking-wide"><i class="fa-solid fa-book-quran mr-1"></i> Rutinan</span>
                                    </div>
                                </div>
                                
                                <div class="p-6 flex flex-col flex-grow">
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @if($item->waktu_acara)
                                        <div class="flex items-center gap-2 text-xs font-bold text-[#059669] bg-emerald-50 px-3 py-1.5 rounded-lg w-max">
                                            <i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($item->waktu_acara)->format('H:i') }} WIB
                                        </div>
                                        @endif
                                        <div class="flex items-center gap-2 text-xs font-bold text-[#059669] bg-emerald-50 px-3 py-1.5 rounded-lg w-max">
                                            <i class="fa-solid fa-users"></i> Terbuka Umum
                                        </div>
                                    </div>
                                    
                                    <h3 class="text-2xl font-bold text-slate-800 mb-2 group-hover:text-[#059669] transition-colors line-clamp-2">
                                        {{ $item->judul }}
                                    </h3>
                                    
                                    <p class="text-slate-600 text-sm line-clamp-3 mb-6">
                                        {{ $item->isi_konten ?? 'Mari hadiri kajian kitab ini untuk memperdalam pemahaman agama dan menyambung tali silaturahmi sesama jamaah.' }}
                                    </p>
                                    
                                    <div class="mt-auto">
                                        <a href="{{ route('kegiatan.detail', $item->id) }}" class="block text-center w-full py-3 bg-emerald-50 text-[#059669] hover:bg-[#059669] hover:text-white font-bold rounded-xl transition border border-emerald-200 hover:border-transparent">
                                            Lihat Detail Kajian
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    @empty
                        <div class="w-full p-8 text-center bg-white rounded-3xl border border-slate-200 shadow-sm col-span-full">
                            <i class="fa-solid fa-book-open text-5xl text-slate-300 mb-4"></i>
                            <p class="text-slate-500 font-medium">Belum ada Kajian Kitab yang dijadwalkan saat ini.</p>
                        </div>
                    @endforelse

                </div>
                <div class="swiper-pagination kitab-pagination"></div>
            </div>
        </div>

        <!-- ================= SECTION KAJIAN RUTIN ================= -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-2 h-8 bg-[#059669] rounded-full"></div>
                <h2 class="text-3xl font-extrabold text-slate-800">Kajian Rutin</h2>
            </div>
            
            <div class="swiper rutinSwiper w-full !pb-12">
                <div class="swiper-wrapper">
                    
                    @forelse($kajianRutin as $item)
                        <div class="swiper-slide h-auto">
                            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden h-full flex flex-col group hover:shadow-xl transition-all duration-300">
                                
                                <div class="relative h-56 overflow-hidden bg-slate-200">
                                    <img src="{{ $item->foto ? asset('images/berita/' . $item->foto) : 'https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?q=80&w=1176&auto=format&fit=crop' }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                                         alt="{{ $item->judul }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    
                                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-center rounded-xl px-3 py-1.5 shadow-lg border border-white/50">
                                        <span class="text-xs font-extrabold text-emerald-600 uppercase tracking-wide"><i class="fa-solid fa-calendar-check mr-1"></i> Tematik</span>
                                    </div>
                                </div>
                                
                                <div class="p-6 flex flex-col flex-grow">
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @if($item->waktu_acara)
                                        <div class="flex items-center gap-2 text-xs font-bold text-[#059669] bg-emerald-50 px-3 py-1.5 rounded-lg w-max">
                                            <i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($item->waktu_acara)->format('H:i') }} WIB
                                        </div>
                                        @endif
                                        <div class="flex items-center gap-2 text-xs font-bold text-[#059669] bg-emerald-50 px-3 py-1.5 rounded-lg w-max">
                                            <i class="fa-solid fa-mosque"></i> Terbuka Umum
                                        </div>
                                    </div>
                                    
                                    <h3 class="text-2xl font-bold text-slate-800 mb-2 group-hover:text-[#059669] transition-colors line-clamp-2">
                                        {{ $item->judul }}
                                    </h3>
                                    
                                    <p class="text-slate-600 text-sm line-clamp-3 mb-6">
                                        {{ $item->isi_konten ?? 'Kajian rutin tematik yang diselenggarakan untuk menjawab persoalan umat dan meningkatkan pemahaman keagamaan.' }}
                                    </p>
                                    
                                    <div class="mt-auto">
                                        <a href="{{ route('kegiatan.detail', $item->id) }}" class="block text-center w-full py-3 bg-emerald-50 text-[#059669] hover:bg-[#059669] hover:text-white font-bold rounded-xl transition border border-emerald-200 hover:border-transparent">
                                            Lihat Detail Kajian
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    @empty
                        <div class="w-full p-8 text-center bg-white rounded-3xl border border-slate-200 shadow-sm col-span-full">
                            <i class="fa-solid fa-folder-open text-5xl text-slate-300 mb-4"></i>
                            <p class="text-slate-500 font-medium">Belum ada Kajian Rutin yang dijadwalkan saat ini.</p>
                        </div>
                    @endforelse

                </div>
                <div class="swiper-pagination rutin-pagination"></div>
            </div>
        </div>

    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiperConfig = {
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: { delay: 5000, disableOnInteraction: true },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 3, spaceBetween: 30 }, 
            }
        };

        new Swiper(".kitabSwiper", {
            ...swiperConfig,
            pagination: { 
                el: ".kitab-pagination", 
                clickable: true,
                dynamicBullets: true 
            }
        });

        new Swiper(".rutinSwiper", {
            ...swiperConfig,
            pagination: { 
                el: ".rutin-pagination", 
                clickable: true,
                dynamicBullets: true 
            }
        });
    </script>
</body>
</html>