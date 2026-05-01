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
            <h3 class="text-2xl font-bold text-green-800 uppercase tracking-wider border-l-4 border-green-800 pl-3">
                Berita Terbaru
            </h3>
        </div>

        @if($news->isEmpty())
            <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-200">
                <i class="fa-solid fa-newspaper text-5xl text-gray-200 mb-4 block"></i>
                <p class="text-gray-500 text-lg">Belum ada berita terbaru saat ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                
                @foreach($news->take(10) as $item)
                <article class="flex flex-col sm:flex-row gap-4 border-b border-gray-100 pb-4 group">
                    <div class="w-full sm:w-2/5 h-48 sm:h-36 overflow-hidden rounded-md flex-shrink-0 relative">
                        <img src="{{ $item->foto ? asset('images/berita/' . $item->foto) : 'https://via.placeholder.com/400x300/e2e8f0/64748b?text=Masjid+Agung' }}" 
                             alt="{{ $item->judul }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-2 left-2">
                            <span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase">
                                {{ $item->kategori }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="w-full sm:w-3/5 flex flex-col justify-center">
                        <a href="{{ route('berita.show', $item->id) }}">
                            <h4 class="text-lg font-bold text-gray-800 leading-snug hover:text-blue-600 transition-colors line-clamp-2 mb-2">
                                {{ $item->judul }}
                            </h4>
                        </a>
                        <div class="flex items-center text-xs text-gray-500 mb-2 gap-3">
                            <span><i class="fa-solid fa-user-pen mr-1"></i> Admin MAS</span>
                            <span><i class="fa-regular fa-clock mr-1"></i> {{ $item->created_at->format('d/m/Y') }}</span>
                        </div>
                        <p class="text-sm text-gray-600 line-clamp-2">
                            {{ Str::limit(strip_tags($item->isi_konten), 90) }}
                        </p>
                    </div>
                </article>
                @endforeach

            </div>

            <div class="mt-10 flex justify-center">
                <a href="{{ url('/kegiatan/semuaBerita') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded transition shadow-md">
                    BERITA LAINNYA
                </a>
            </div>
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
    @if(session('welcome'))
        <script>
            alert("{{ session('welcome') }}");
        </script>
    @endif
</body>
</html>