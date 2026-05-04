@php
$pendidikanPosters = $pendidikanPosters ?? collect();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendidikan - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    @include('navbar')

    <main class="flex-grow max-w-7xl mx-auto px-4 py-12 w-full overflow-hidden">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-green-800 mb-2">Program Pendidikan</h1>
            <p class="text-gray-600">Informasi pendaftaran dan kegiatan belajar mengajar.</p>
        </div>

        <div class="swiper pendidikanSwiper w-full py-4">
            <div class="swiper-wrapper">
                @forelse($pendidikanPosters as $item)
                <div class="swiper-slide">
                    <div class="relative bg-white rounded-xl shadow-md overflow-hidden h-[450px] w-full group">
                        <a href="{{ route('pendidikan.show', $item->id) }}">
                            <img src="{{ $item->foto ? asset('images/berita/' . $item->foto) : 'https://via.placeholder.com/800x500' }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform"
                                alt="{{ $item->judul }}">
                        </a>
                        <div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white p-3 text-sm">
                            {{ $item->judul }}
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500">Belum ada program pendidikan.</p>
                @endforelse
            </div>
            <div class="swiper-pagination !relative !mt-6"></div>
        </div>
    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".pendidikanSwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: { el: ".swiper-pagination", clickable: true },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 3, spaceBetween: 30 },
            }
        });
    </script>
</body>
</html>