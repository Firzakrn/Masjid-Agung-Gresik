<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Berita & Kegiatan | Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    @include('navbar')

    <section class="max-w-7xl mx-auto px-4 py-12 flex flex-col md:flex-row gap-8">
        
        <aside class="w-full md:w-1/4">
            <div class="sticky top-28 bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-2 mb-4 border-b border-gray-100 pb-3">
                    <i class="fa-solid fa-filter text-green-600"></i>
                    <h3 class="text-lg font-extrabold text-gray-900 tracking-tight">Kategori</h3>
                </div>

                <div class="flex flex-col gap-2">
                    <button class="filter-btn text-left bg-white text-gray-600 border border-gray-100 hover:bg-green-600 hover:text-white px-4 py-2.5 rounded-lg font-bold transition duration-300 text-sm shadow-sm" data-filter="all">
                        <i class="fa-solid fa-border-all w-5 text-center mr-1"></i> Semua
                    </button>
                    
                    <button id="defaultFilter" class="filter-btn active bg-green-600 text-white border border-green-600 px-4 py-2.5 rounded-lg font-bold transition duration-300 text-sm shadow-sm text-left" data-filter="berita">
                        <i class="fa-regular fa-newspaper w-5 text-center mr-1"></i> Berita
                    </button>
                    
                    <button class="filter-btn text-left bg-white text-gray-600 border border-gray-100 hover:bg-green-600 hover:text-white px-4 py-2.5 rounded-lg font-bold transition duration-300 text-sm shadow-sm" data-filter="kajian">
                        <i class="fa-solid fa-book-open-reader w-5 text-center mr-1"></i> Kajian
                    </button>
                    
                    <button class="filter-btn text-left bg-white text-gray-600 border border-gray-100 hover:bg-green-600 hover:text-white px-4 py-2.5 rounded-lg font-bold transition duration-300 text-sm shadow-sm" data-filter="agenda">
                        <i class="fa-regular fa-calendar-check w-5 text-center mr-1"></i> Agenda
                    </button>
                    
                    <button class="filter-btn text-left bg-white text-gray-600 border border-gray-100 hover:bg-green-600 hover:text-white px-4 py-2.5 rounded-lg font-bold transition duration-300 text-sm shadow-sm" data-filter="pendidikan">
                        <i class="fa-solid fa-graduation-cap w-5 text-center mr-1"></i> Pendidikan
                    </button>
                </div>
            </div>
        </aside>

        <div class="w-full md:w-3/4">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-6 bg-green-600 rounded-full"></div>
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Pusat Informasi</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="newsContainer">
                @forelse($semuaBerita as $item)
                <article class="news-item bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group" 
                         data-kat="{{ $item->kategori }}" 
                         data-sub="{{ $item->sub_kategori ?? '' }}">
                    
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ $item->foto ? asset('images/berita/' . $item->foto) : 'https://via.placeholder.com/600x400' }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        
                        <div class="absolute top-3 left-3 flex gap-2">
                            <span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase shadow-sm">
                                {{ $item->kategori }}
                            </span>
                            @if($item->sub_kategori)
                            <span class="bg-green-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase shadow-sm">
                                {{ str_replace('_', ' ', $item->sub_kategori) }}
                            </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-5">
                        <p class="text-[11px] text-gray-400 mb-2"><i class="fa-regular fa-calendar-alt mr-1"></i> {{ $item->created_at->format('d M Y') }}</p>
                        <a href="{{ route('berita.show', $item->id) }}">
                            <h4 class="text-lg font-bold text-gray-800 line-clamp-2 hover:text-green-600 transition mb-2 leading-snug">
                                {{ $item->judul }}
                            </h4>
                        </a>
                        <p class="text-xs text-gray-500 line-clamp-2 mb-4">{{ Str::limit(strip_tags($item->isi_konten), 100) }}</p>
                        <a href="{{ route('berita.show', $item->id) }}" class="inline-block text-green-600 font-bold text-xs hover:text-green-800 transition">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </article>
                @empty
                <div class="col-span-1 md:col-span-2 text-center py-10 border border-dashed border-gray-300 rounded-xl bg-white">
                    <p class="text-gray-500">Belum ada publikasi saat ini.</p>
                </div>
                @endforelse
            </div>
            
            <div id="emptyMessage" class="hidden text-center py-12 border border-dashed border-gray-300 rounded-2xl bg-white mt-4">
                <p class="text-gray-500 font-medium"><i class="fa-solid fa-magnifying-glass text-3xl block mb-3 text-gray-300"></i> Tidak ada publikasi di kategori ini.</p>
            </div>
        </div>

    </section>

    @include('footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const newsItems = document.querySelectorAll('.news-item');
            const emptyMessage = document.getElementById('emptyMessage');
            const defaultFilterBtn = document.getElementById('defaultFilter'); // Ambil tombol Berita

            // Logika saat tombol filter diklik
            function applyFilter(btnElement) {
                // 1. Reset tampilan semua tombol menjadi putih/abu
                filterBtns.forEach(b => {
                    b.classList.remove('bg-green-600', 'text-white', 'border-green-600');
                    b.classList.add('bg-white', 'text-gray-600', 'border-gray-100');
                });

                // 2. Beri warna hijau pada tombol yang sedang aktif
                btnElement.classList.remove('bg-white', 'text-gray-600', 'border-gray-100');
                btnElement.classList.add('bg-green-600', 'text-white', 'border-green-600');

                // 3. Ambil kata kunci filter
                const filterValue = btnElement.getAttribute('data-filter');
                let countVisible = 0;

                // 4. Proses memunculkan/menyembunyikan
                newsItems.forEach(item => {
                    const kat = item.getAttribute('data-kat');
                    const sub = item.getAttribute('data-sub');

                    let isMatch = false;
                    if (filterValue === 'all') {
                        isMatch = true;
                    } else if (filterValue === 'berita' && kat === 'berita') {
                        isMatch = true;
                    } else if (sub.includes(filterValue)) {
                        isMatch = true;
                    }

                    if (isMatch) {
                        item.style.display = 'block';
                        countVisible++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // 5. Pesan kosong
                if (countVisible === 0) {
                    emptyMessage.classList.remove('hidden');
                } else {
                    emptyMessage.classList.add('hidden');
                }
            }

            // Pasang event click ke semua tombol
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    applyFilter(this);
                });
            });

            // Trik Ajaib: Saat halaman pertama dimuat, paksa sistem mengeklik tombol Berita secara otomatis
            if (defaultFilterBtn) {
                applyFilter(defaultFilterBtn);
            }
        });
    </script>
</body>
</html>