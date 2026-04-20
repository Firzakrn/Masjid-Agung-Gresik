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

    <div class="w-full h-[400px] md:h-[500px] relative">
        <div class="swiper heroSwiper w-full h-full">
            <div class="swiper-wrapper">
                <div class="swiper-slide relative">
                    <img src="https://images.unsplash.com/photo-1519817650390-64a93db51149?q=80&w=2000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Hari Berkah">
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                        <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-lg">Hari Berkah</h1>
                    </div>
                </div>
                <div class="swiper-slide relative">
                    <img src="https://images.unsplash.com/photo-1609599006353-e629aaab31bf?q=80&w=2000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Baca Bersama">
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                        <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-lg">Baca Bersama</h1>
                    </div>
                </div>
                <div class="swiper-slide relative">
                    <img src="https://images.unsplash.com/photo-1594968832043-a6167c1e5d36?q=80&w=2000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Manqib Jumat Awal">
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                        <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-lg">Manqib Jumat Awal</h1>
                    </div>
                </div>
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
                <div class="swiper-slide">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 h-[400px] w-full">
                        <img src="https://images.unsplash.com/photo-1542816417-0983c9c9ad53?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Poster Agenda">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 h-[400px] w-full">
                        <img src="https://images.unsplash.com/photo-1584030373081-f37b7bb4fa8e?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Poster Agenda">
                    </div>
                </div>
                </div>
            <div class="swiper-pagination !relative !mt-6"></div>
        </div>
    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Setup slider untuk Banner Utama
        new Swiper(".heroSwiper", {
            loop: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        });

        // Setup slider untuk Poster (tampil lebih dari 1 kartu sekaligus)
        new Swiper(".posterSwiper", {
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