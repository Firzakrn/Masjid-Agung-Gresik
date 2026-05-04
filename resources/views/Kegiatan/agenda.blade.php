@php
$agendaPosters = $agendaPosters ?? collect();
$heroAgenda = $heroAgenda ?? collect();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Masjid - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .swiper-slide { text-align: center; display: flex; justify-content: center; align-items: center; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    @include('navbar')

    {{-- Hero Slider --}}
    <div class="w-full h-[400px] md:h-[500px] relative">
        <div class="swiper heroSwiper w-full h-full">
            <div class="swiper-wrapper">
                @forelse($heroAgenda as $item)
                <div class="swiper-slide relative">
                    <img src="{{ $item->foto ? asset('images/agenda/' . $item->foto) : 'https://via.placeholder.com/2000x500' }}"
                        class="w-full h-full object-cover" alt="{{ $item->judul }}">
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                        <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-lg">{{ $item->judul }}</h1>
                    </div>
                </div>
                @empty
                <div class="swiper-slide relative">
                    <img src="https://via.placeholder.com/2000x500" class="w-full h-full object-cover" alt="Agenda">
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                        <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-lg">Agenda Masjid</h1>
                    </div>
                </div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next !text-white"></div>
            <div class="swiper-button-prev !text-white"></div>
        </div>
    </div>

    <main class="flex-grow max-w-7xl mx-auto px-4 py-12 w-full overflow-hidden">
        <h2 class="text-3xl font-bold text-green-800 mb-6 border-l-4 border-green-600 pl-4">Poster Agenda Mendatang</h2>

        <div class="swiper posterSwiper w-full py-4">
            <div class="swiper-wrapper">
                @forelse($agendaPosters as $item)
                <div class="swiper-slide">
                    <div class="relative bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 h-[400px] w-full group">
                        <a href="{{ route('agenda.show', $item->id) }}">
                            <img src="{{ $item->foto ? asset('images/berita/' . $item->foto) : 'https://via.placeholder.com/800x500' }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                alt="{{ $item->judul }}">
                        </a>
                        <div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white p-3 text-sm">
                            {{ $item->judul }}
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500">Belum ada poster agenda.</p>
                @endforelse
            </div>
            <div class="swiper-pagination-poster !relative !mt-6"></div>
        </div>
    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".heroSwiper", {
            loop: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        });

        new Swiper(".posterSwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: { el: ".swiper-pagination-poster", clickable: true },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 3, spaceBetween: 30 },
            }
        });
    </script>
</body>
</html>