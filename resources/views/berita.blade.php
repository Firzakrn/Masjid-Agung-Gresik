<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    @include('navbar')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-2/3 bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                <h1 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4 leading-tight">
                    {{ $berita->judul }}
                </h1>
                
                <div class="flex flex-wrap items-center text-sm text-gray-500 gap-4 mb-6 border-b border-gray-100 pb-4">
                    <span class="text-blue-600 font-semibold"><i class="fa-solid fa-tags"></i> {{ ucfirst($berita->kategori) }}</span>
                    <span><i class="fa-regular fa-calendar"></i> {{ $berita->created_at->translatedFormat('l, d F Y') }}</span>
                    <span><i class="fa-regular fa-clock"></i> {{ $berita->created_at->format('H:i') }} WIB</span>
                </div>

                <div class="w-full h-auto max-h-[500px] overflow-hidden rounded-lg mb-8 bg-gray-100">
                    <img src="{{ $berita->foto ? asset('images/berita/' . $berita->foto) : 'https://via.placeholder.com/800x500?text=Masjid+Agung' }}" 
                         alt="{{ $berita->judul }}" 
                         class="w-full h-full object-contain">
                </div>

                <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                    {!! nl2br(e($berita->isi_konten)) !!}
                </div>
                
                <div class="mt-10 pt-6 border-t border-gray-100 flex items-center gap-3">
                    <span class="font-bold text-sm">Share :</span>
                    <button class="w-8 h-8 rounded bg-blue-800 text-white flex items-center justify-center hover:bg-blue-900 transition"><i class="fa-brands fa-facebook-f"></i></button>
                    <button class="w-8 h-8 rounded bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition"><i class="fa-brands fa-twitter"></i></button>
                    <button class="w-8 h-8 rounded bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition"><i class="fa-brands fa-whatsapp"></i></button>
                </div>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-blue-800 text-white font-bold p-3 uppercase tracking-wider mb-4 rounded-t-lg">
                    Berita Terbaru
                </div>
                
                <div class="bg-white p-5 rounded-b-lg shadow-sm border border-gray-100 flex flex-col gap-5">
                    @foreach($beritaTerbaru as $terbaru)
                    <div class="flex gap-4 group">
                        <div class="w-24 h-20 rounded-md overflow-hidden flex-shrink-0 bg-gray-200">
                            <img src="{{ $terbaru->foto ? asset('images/berita/' . $terbaru->foto) : 'https://via.placeholder.com/150x150?text=News' }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="flex flex-col justify-center">
                            <a href="{{ route('berita.show', $terbaru->id) }}" class="font-bold text-sm text-gray-800 hover:text-blue-600 leading-snug line-clamp-2 mb-1">
                                {{ $terbaru->judul }}
                            </a>
                            <span class="text-xs text-gray-400">{{ $terbaru->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </main>

    @include('footer')
</body>
</html>