<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    
    @include('navbar')

    <header class="relative min-h-[400px] md:min-h-[500px] flex items-center justify-center overflow-hidden shadow-xl">
        
        <div class="absolute inset-0 z-0">
            <img id="bg-img-1" src="{{ asset('images/siang.jpeg') }}" 
                 class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out opacity-100" 
                 alt="Masjid Siang">
                 
            <img id="bg-img-2" src="{{ asset('images/malam.jpg') }}" 
                 class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out opacity-0" 
                 alt="Masjid Malam">
                 
            <div class="absolute inset-0 bg-black/60"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-4 tracking-wider uppercase drop-shadow-2xl">
                Masjid Agung Gresik
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-10 drop-shadow-lg font-medium">
                Kabupaten Gresik - Jawa Timur
            </p>
        </div>
    </header>
    
    <main class="max-w-7xl mx-auto px-4 py-16">
        
        <div class="mb-8 border-b-2 border-gray-200 pb-2 flex items-center justify-between">
            <h3 class="text-2xl font-bold text-blue-800 uppercase tracking-wider border-l-4 border-blue-800 pl-3">
                Berita Terbaru
            </h3>
        </div>

        @if($news->isEmpty())
            <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-200">
                <p class="text-gray-500 text-lg">Belum ada berita terbaru saat ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                
                @php $beritaUtama = $news->first(); @endphp
                <div class="lg:col-span-2 relative group overflow-hidden bg-gray-200 aspect-video lg:aspect-auto h-[300px] lg:h-auto rounded-l-lg">
                    <img src="{{ $beritaUtama->FOTO_NEWS ? asset('storage/' . $beritaUtama->FOTO_NEWS) : asset('images/default-news.jpg') }}" alt="Berita Utama" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    
                    <a href="{{ url('/berita/'.$beritaUtama->id) }}" class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></a>
                    
                    <div class="absolute bottom-0 left-0 p-6 w-full lg:w-[85%]">
                        <span class="bg-blue-700 text-white text-xs font-bold px-3 py-1 uppercase rounded-sm">Update</span>
                        <a href="{{ url('/berita/'.$beritaUtama->id) }}">
                            <h4 class="text-2xl md:text-3xl font-bold text-white mt-3 mb-2 leading-tight hover:text-blue-300 transition-colors line-clamp-2 shadow-sm">
                                {{ $beritaUtama->JUDUL_NEWS }}
                            </h4>
                        </a>
                        <p class="text-sm text-gray-300 line-clamp-2 mt-2 hidden md:block">
                            {{ Str::limit(strip_tags($beritaUtama->ISI_NEWS), 120) }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-2 h-full">
                    @foreach($news as $index => $item)
                        @if($index > 0 && $index <= 3)
                            <div class="relative group overflow-hidden bg-gray-200 flex-1 min-h-[120px] lg:min-h-[150px] {{ $index == 3 ? 'rounded-br-lg' : ($index == 1 ? 'rounded-tr-lg' : '') }}">
                                <img src="{{ $item->FOTO_NEWS ? asset('storage/' . $item->FOTO_NEWS) : asset('images/default-news.jpg') }}" alt="Berita" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                <a href="{{ url('/berita/'.$item->id) }}" class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></a>
                                <div class="absolute bottom-0 left-0 p-4 w-full">
                                    <a href="{{ url('/berita/'.$item->id) }}">
                                        <h4 class="text-sm md:text-base font-bold text-white leading-snug hover:text-blue-300 transition-colors line-clamp-2">
                                            {{ $item->JUDUL_NEWS }}
                                        </h4>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            @if(count($news) > 4)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                    @foreach($news as $index => $item)
                        @if($index > 3)
                            <article class="flex gap-4 bg-white p-3 rounded-lg shadow-sm hover:shadow-md border border-gray-100 transition-shadow">
                                <div class="w-1/3 flex-shrink-0 h-24 overflow-hidden rounded-md">
                                    <img src="{{ $item->FOTO_NEWS ? asset('storage/' . $item->FOTO_NEWS) : asset('images/default-news.jpg') }}" alt="{{ $item->JUDUL_NEWS }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="w-2/3 flex flex-col justify-center">
                                    <a href="{{ url('/berita/'.$item->id) }}">
                                        <h4 class="font-bold text-sm text-gray-800 hover:text-blue-700 transition-colors line-clamp-2 mb-1">
                                            {{ $item->JUDUL_NEWS }}
                                        </h4>
                                    </a>
                                    <p class="text-xs text-gray-500 line-clamp-2">{{ Str::limit(strip_tags($item->ISI_NEWS), 60) }}</p>
                                </div>
                            </article>
                        @endif
                    @endforeach
                </div>
            @endif
        @endif
    </main>

    @include('footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const img1 = document.getElementById('bg-img-1');
            const img2 = document.getElementById('bg-img-2');
            let isSiang = true; // Status awal gambar 1 (siang) muncul

            // Jalankan ganti gambar setiap 5000 milidetik (5 detik)
            setInterval(() => {
                if (isSiang) {
                    img1.classList.remove('opacity-100');
                    img1.classList.add('opacity-0');
                    
                    img2.classList.remove('opacity-0');
                    img2.classList.add('opacity-100');
                } else {
                    // Sembunyikan sore, munculkan siang
                    img2.classList.remove('opacity-100');
                    img2.classList.add('opacity-0');
                    
                    img1.classList.remove('opacity-0');
                    img1.classList.add('opacity-100');
                }
                // Balikkan statusnya
                isSiang = !isSiang;
            }, 5000); 
        });
    </script>
</body>
</html>