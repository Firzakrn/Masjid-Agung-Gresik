<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $agenda->judul }} - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    @include('navbar')

    <main class="flex-grow max-w-7xl mx-auto px-4 py-12 w-full">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Konten Utama --}}
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-green-800 mb-4">{{ $agenda->judul }}</h1>
                <p class="text-sm text-gray-400 mb-6">
                    <i class="fa fa-calendar mr-1"></i>
                    {{ $agenda->created_at->format('d F Y') }}
                </p>

                @if($agenda->foto)
                <img src="{{ asset('images/berita/' . $agenda->foto) }}"
                    class="w-full max-h-[500px] object-cover rounded-xl mb-6 shadow"
                    alt="{{ $agenda->judul }}">
                @endif

                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($agenda->isi_konten)) !!}
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="w-full lg:w-72 shrink-0">
                <h2 class="text-xl font-bold text-green-800 mb-4 border-b-2 border-green-200 pb-2">
                    Agenda Terbaru
                </h2>
                <div class="flex flex-col gap-4">
                    @foreach($agendaTerbaru as $item)
                    <a href="{{ route('agenda.show', $item->id) }}"
                        class="flex gap-3 items-start hover:bg-green-50 p-2 rounded-lg transition">
                        <img src="{{ $item->foto ? asset('images/berita/' . $item->foto) : 'https://via.placeholder.com/100' }}"
                            class="w-16 h-16 object-cover rounded-lg shrink-0"
                            alt="{{ $item->judul }}">
                        <div>
                            <p class="text-sm font-semibold text-gray-800 line-clamp-2">{{ $item->judul }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $item->created_at->format('d F Y') }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

        </div>
    </main>

    @include('footer')
</body>
</html>