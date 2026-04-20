<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kajian - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    @include('navbar')

    <main class="flex-grow max-w-7xl mx-auto px-4 py-12 w-full overflow-hidden">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-green-800 mb-2">Jadwal Kajian</h1>
            <p class="text-gray-600">Tingkatkan ilmu agama melalui kajian kitab dan rutin bersama asatidz.</p>
        </div>

        <h2 class="text-2xl font-bold text-green-800 mb-4 border-b-2 border-green-200 pb-2">Kajian Kitab</h2>
        <div class="swiper kajianSwiper w-full py-4 mb-10">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden h-[400px] w-full">
                        <img src="https://images.unsplash.com/photo-1585036156171-384164a8c675?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover hover:scale-105 transition-transform" alt="Kajian Kitab 1">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination !relative !mt-6"></div>
        </div>

        <h2 class="text-2xl font-bold text-green-800 mb-4 border-b-2 border-green-200 pb-2 mt-8">Kajian Rutin</h2>
        <div class="swiper kajianSwiper w-full py-4 mb-4">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden h-[400px] w-full">
                        <img src="https://images.unsplash.com/photo-1609599006353-e629aaab31bf?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover hover:scale-105 transition-transform" alt="Kajian Rutin 1">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination !relative !mt-6"></div>
        </div>
    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Setup slider untuk semua Swiper kajian
        const swipers = document.querySelectorAll('.kajianSwiper');
        swipers.forEach(function(swiperElem) {
            new Swiper(swiperElem, {
                slidesPerView: 1,
                spaceBetween: 20,
                pagination: { el: swiperElem.querySelector('.swiper-pagination'), clickable: true },
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 20 },
                    1024: { slidesPerView: 4, spaceBetween: 30 }, // Menampilkan 4 poster di layar PC
                }
            });
        });
    </script>
</body>
</html>