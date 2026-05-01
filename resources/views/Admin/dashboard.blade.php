<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Menghilangkan scrollbar tapi tetap bisa di-scroll menyamping */
        .hide-scroll-bar::-webkit-scrollbar {
            display: none;
        }
        .hide-scroll-bar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans flex h-screen overflow-hidden">
    
    @include('Admin.navbarAdm')
    
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50">
        
        <header class="md:hidden bg-green-900 text-white p-4 flex justify-between items-center flex-shrink-0">
            <h1 class="text-lg font-bold"><i class="fa-solid fa-mosque"></i> Admin Masjid</h1>
            <button class="text-white"><i class="fa-solid fa-bars text-xl"></i></button>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-10">
            
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Overview Dashboard</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Total Pengunjung Web</p>
                        <h3 class="text-4xl font-bold text-gray-800">1,254</h3>
                        <p class="text-xs text-green-600 mt-2"><i class="fa-solid fa-arrow-trend-up"></i> +14% bulan ini (Dummy)</p>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Jamaah Terdaftar (Login)</p>
                        <h3 class="text-4xl font-bold text-gray-800">{{ $totalJamaah ?? 0 }}</h3>
                        <p class="text-xs text-green-600 mt-2">
                            <i class="fa-solid fa-arrow-trend-up"></i> +{{ $jamaahBaruBulanIni ?? 0 }} jamaah baru bulan ini
                        </p>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-green-50 text-green-600 flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Update Struktur Organisasi</h3>
                <form action="#" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row items-start md:items-end gap-4">
                    <div class="w-full md:flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar Struktur Baru (JPG/PNG)</label>
                        <input type="file" name="struktur_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 border border-gray-200 rounded-lg p-1 bg-gray-50 cursor-pointer focus:outline-none">
                    </div>
                    <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg font-semibold shadow-sm transition whitespace-nowrap w-full md:w-auto mt-2 md:mt-0">
                        <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Update Struktur
                    </button>
                </form>
            </div>

            <div class="mb-8">
                <div class="flex justify-between items-end mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Publikasi Terbaru</h3>
                    <a href="{{ route('admin.berita') }}" class="text-sm text-green-600 hover:underline">Lihat Semua</a>
                </div>
                
                <div class="flex overflow-x-auto hide-scroll-bar gap-4 pb-4 snap-x">
                    @if(isset($beritaTerbaru) && $beritaTerbaru->count() > 0)
                        @foreach($beritaTerbaru as $berita)
                        <div class="min-w-[280px] w-[280px] bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden snap-center flex-shrink-0 group cursor-pointer">
                            <div class="h-32 bg-gray-200 relative overflow-hidden">
                                @if($berita->foto)
                                    <img src="{{ asset('images/berita/' . $berita->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $berita->judul }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-green-100 text-green-500">
                                        <i class="fa-solid fa-mosque text-3xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <span class="text-[10px] font-bold text-white {{ $berita->kategori == 'berita' ? 'bg-blue-600' : 'bg-purple-600' }} px-2 py-1 rounded uppercase tracking-wider">
                                    {{ $berita->kategori }}
                                </span>
                                <h4 class="font-bold text-gray-800 mt-2 line-clamp-2 leading-tight group-hover:text-green-700 transition">
                                    {{ $berita->judul }}
                                </h4>
                                <p class="text-xs text-gray-400 mt-3">
                                    <i class="fa-regular fa-clock"></i> Diperbarui {{ $berita->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="w-full text-center py-10 bg-white rounded-xl border border-dashed border-gray-300">
                            <p class="text-gray-500 text-sm">Belum ada publikasi berita atau kegiatan.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-10">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-800">Aktivitas Pencatatan Terakhir</h3>
                    <a href="#" class="text-sm text-green-600 hover:underline">Kelola Data</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4 font-bold">Waktu</th>
                                <th class="px-6 py-4 font-bold">Jenis Pencatatan</th>
                                <th class="px-6 py-4 font-bold">Keterangan</th>
                                <th class="px-6 py-4 font-bold">Tipe User</th>
                                <th class="px-6 py-4 font-bold text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-green-50/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">Hari ini, 10:45 WIB</td>
                                <td class="px-6 py-4 font-semibold text-gray-800">Infaq QRIS</td>
                                <td class="px-6 py-4 truncate max-w-xs">Masuk dana sebesar Rp 150.000 (Dummy Data)</td>
                                <td class="px-6 py-4">Hamba Allah</td>
                                <td class="px-6 py-4 text-right">
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Berhasil</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-green-50/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">Hari ini, 09:12 WIB</td>
                                <td class="px-6 py-4 font-semibold text-gray-800">DP Reservasi</td>
                                <td class="px-6 py-4 truncate max-w-xs">Masuk dana sebesar Rp 1.000.000 untuk Intimate Wedding</td>
                                <td class="px-6 py-4">Jamaah Terdaftar</td>
                                <td class="px-6 py-4 text-right">
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Pending</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div> 
    </main>
</body>
</html>