<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kegiatan->judul }} - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen text-slate-800">
    
    @include('navbar')

    <main class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 py-12 w-full">
        
        <!-- Tombol Kembali -->
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-green-600 font-bold mb-8 transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>

        <!-- Konten Detail -->
        <article class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <!-- Gambar Cover -->
            <div class="w-full h-64 md:h-96 bg-slate-200 overflow-hidden relative">
                <img src="{{ $kegiatan->foto ? asset('images/berita/' . $kegiatan->foto) : 'https://images.unsplash.com/photo-1629273229214-d96be4552b9a?q=80&w=1170&auto=format&fit=crop' }}" 
                     class="w-full h-full object-cover" 
                     alt="{{ $kegiatan->judul }}">
                     
                <!-- Badge Kategori -->
                <div class="absolute top-4 left-4 bg-green-600 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-md">
                    {{ str_replace('_', ' ', $kegiatan->sub_kategori) }}
                </div>
            </div>

            <!-- Teks Konten -->
            <div class="p-8 md:p-12">
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-4">{{ $kegiatan->judul }}</h1>
                
                <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 font-medium mb-8 border-b border-slate-100 pb-6">
                    <!-- Menampilkan Waktu Acara Jika Ada -->
                    @if($kegiatan->waktu_acara)
                        <span class="flex items-center gap-1.5 text-blue-600 bg-blue-50 px-3 py-1 rounded-lg">
                            <i class="fa-regular fa-calendar"></i> 
                            {{ \Carbon\Carbon::parse($kegiatan->waktu_acara)->translatedFormat('d F Y, H:i') }} WIB
                        </span>
                    @endif
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-clock"></i> Dipublikasikan: {{ $kegiatan->created_at->diffForHumans() }}</span>
                </div>

                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed whitespace-pre-wrap">
                    {{ $kegiatan->isi_konten }}
                </div>
            </div>
        </article>

    </main>

    @include('footer')

</body>
</html>