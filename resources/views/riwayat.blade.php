<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Aktivitas - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col">

    <!-- Header Sederhana -->
    <div class="bg-green-700 text-white p-6 shadow-md">
        <div class="max-w-5xl mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-bold">Dasboard {{ Auth::user()->name }}</h1>
            <a href="{{ url('/') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm font-semibold transition">
                <i class="fa-solid fa-home mr-1"></i> Beranda
            </a>
        </div>
    </div>

    <!-- Konten Utama (Menggunakan Alpine.js untuk fitur Tab) -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-10 w-full flex-grow" x-data="{ activeTab: 'reservasi' }">
        
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-slate-800 mb-2">Riwayat & Status</h2>
            <p class="text-slate-500">Pantau proses reservasi acara dan penyaluran ZIS Anda.</p>
        </div>

        <!-- TAB NAVIGASI -->
        <div class="flex space-x-2 bg-white p-2 rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-x-auto">
            <button @click="activeTab = 'reservasi'" 
                    :class="activeTab === 'reservasi' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-50'"
                    class="flex-1 py-3 px-6 rounded-xl transition flex items-center justify-center gap-2 whitespace-nowrap">
                <i class="fa-regular fa-calendar-check"></i> Riwayat Reservasi
            </button>
            <button @click="activeTab = 'zis'" 
                    :class="activeTab === 'zis' ? 'bg-green-50 text-green-700 font-bold' : 'text-slate-600 hover:bg-slate-50'"
                    class="flex-1 py-3 px-6 rounded-xl transition flex items-center justify-center gap-2 whitespace-nowrap">
                <i class="fa-solid fa-hand-holding-dollar"></i> Riwayat ZIS
            </button>
        </div>

        <!-- TAB KONTEN 1: RESERVASI -->
        <div x-show="activeTab === 'reservasi'" x-transition.opacity.duration.400ms>
            @if($reservasis->isEmpty())
                <div class="text-center bg-white p-12 rounded-3xl border border-slate-100 shadow-sm">
                    <div class="w-20 h-20 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                        <i class="fa-regular fa-folder-open"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Belum ada reservasi</h3>
                    <p class="text-slate-500 mb-6">Anda belum pernah melakukan pemesanan fasilitas masjid.</p>
                    <a href="{{ route('reservasi.socialevent') }}" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition">Buat Reservasi Baru</a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($reservasis as $rs)
                        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 hover:border-blue-200 transition">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">ID: #RSV-{{ str_pad($rs->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    <h3 class="text-xl font-bold text-slate-800">{{ $rs->paket }}</h3>
                                </div>
                                
                                <!-- Logika Warna Status Badge -->
                                {{-- Sesudah --}}
                                @if(stripos($rs->status, 'Menunggu') !== false)
                                    <span class="bg-yellow-100 text-yellow-700 border border-yellow-200 text-xs font-bold px-3 py-1.5 rounded-lg text-center">
                                        {{ $rs->status }}
                                    </span>
                                @elseif($rs->status === 'Lunas')
                                    <span class="bg-green-100 text-green-700 border border-green-200 text-xs font-bold px-3 py-1.5 rounded-lg text-center">
                                        ✓ Lunas
                                    </span>
                                @elseif(stripos($rs->status, 'Selesai') !== false)
                                    <span class="bg-green-100 text-green-700 border border-green-200 text-xs font-bold px-3 py-1.5 rounded-lg text-center">
                                        {{ $rs->status }}
                                    </span>
                                @else
                                    <span class="bg-slate-100 text-slate-600 border border-slate-200 text-xs font-bold px-3 py-1.5 rounded-lg text-center">
                                        {{ $rs->status }}
                                    </span>
                                @endif
                            </div>
                            
                            <div class="space-y-3 bg-slate-50 p-4 rounded-2xl mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500"><i class="fa-regular fa-calendar mr-1"></i> Tanggal</span>
                                    <span class="font-bold text-slate-800">{{ $rs->tanggal }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500"><i class="fa-regular fa-clock mr-1"></i> Sesi</span>
                                    <span class="font-bold text-slate-800">{{ $rs->sesi }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500"><i class="fa-regular fa-user mr-1"></i> Pemohon</span>
                                    <span class="font-bold text-slate-800">{{ $rs->nama_pemohon }}</span>
                                </div>
                            </div>

                            @if(stripos($rs->status, 'Menunggu Pembayaran DP') !== false)
                                <a href="{{ route('reservasi.pembayaran', $rs->id) }}" class="block w-full text-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-bold py-3 rounded-xl transition border border-blue-200 hover:border-transparent">
                                    Lanjutkan Pembayaran
                                </a>
                            @endif
                            @if($rs->status_dp === 'disetujui' && $rs->status !== 'Lunas')
                            @php $sisa = $rs->grand_total - $rs->nominal_dp; @endphp
                            <a href="{{ route('reservasi.pelunasan', $rs->id) }}"
                            class="block w-full text-center bg-green-50 text-green-600 hover:bg-green-600 hover:text-white font-bold py-3 rounded-xl transition border border-green-200 hover:border-transparent mt-2">
                                Lunasi Sekarang
                            </a>
                        @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- TAB KONTEN 2: ZIS (Zakat, Infaq, Shadaqah) -->
        <!-- TAB KONTEN 2: ZIS (Zakat, Infaq, Shadaqah) -->
            <div x-show="activeTab === 'zis'" style="display: none;" x-transition.opacity.duration.400ms>
                @if($riwayatZis->isEmpty())
                    <div class="text-center bg-white p-12 rounded-3xl border border-slate-100 shadow-sm">
                        <div class="w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Belum ada riwayat ZIS</h3>
                        <p class="text-slate-500 mb-6">Mari sempurnakan ibadah dengan menunaikan Zakat dan Infaq.</p>
                        <a href="{{ url('/infaq/zis') }}" class="bg-green-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-700 transition">Tunaikan Sekarang</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($riwayatZis as $zis)
                            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex flex-col h-full hover:-translate-y-1 transition duration-300">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-12 h-12 rounded-full bg-green-50 text-green-600 flex items-center justify-center text-xl">
                                        <i class="fa-solid fa-rupiah-sign"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-800">{{ $zis->jenis_dana }}</h3>
                                        <p class="text-xs text-slate-500">{{ $zis->created_at->format('d F Y') }}</p>
                                    </div>
                                </div>
                                
                                <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                                    <span class="text-lg font-extrabold text-slate-900">Rp {{ number_format($zis->jumlah_dana, 0, ',', '.') }}</span>
                                    
                                    @if($zis->status === 'disetujui')
                                        <span class="text-xs font-bold text-green-600 bg-green-50 px-2.5 py-1 rounded-md"><i class="fa-solid fa-check mr-1"></i> Disetujui</span>
                                    @elseif($zis->status === 'ditolak')
                                        <span class="text-xs font-bold text-red-600 bg-red-50 px-2.5 py-1 rounded-md"><i class="fa-solid fa-times mr-1"></i> Ditolak</span>
                                    @else
                                        <span class="text-xs font-bold text-orange-600 bg-orange-50 px-2.5 py-1 rounded-md"><i class="fa-solid fa-clock mr-1"></i> Menunggu Verifikasi</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

    </div>
</body>
</html>