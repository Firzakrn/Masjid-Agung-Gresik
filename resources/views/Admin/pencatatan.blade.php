<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan & Persetujuan | Admin Masjid</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hide-scroll-bar::-webkit-scrollbar { display: none; }
        .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-100 font-sans flex h-screen overflow-hidden text-slate-800">

    @include('admin.navbarAdm')

    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50 relative">
        
        <header class="md:hidden bg-green-800 text-white p-4 flex justify-between items-center flex-shrink-0">
            <h1 class="text-lg font-bold"><i class="fa-solid fa-mosque"></i> Keuangan Masjid</h1>
            <button class="text-white"><i class="fa-solid fa-bars text-xl"></i></button>
        </header>

        <div class="flex-1 overflow-y-auto relative p-4 md:p-8" id="scrollArea">

            {{-- FLASH MESSAGE --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl text-sm font-semibold">
                    <i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-xl text-sm font-semibold">
                    <i class="fa-solid fa-circle-xmark mr-2"></i>{{ session('error') }}
                </div>
            @endif
            @if(session('info'))
                <div class="mb-4 bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded-xl text-sm font-semibold">
                    <i class="fa-solid fa-circle-info mr-2"></i>{{ session('info') }}
                </div>
            @endif

            <!-- HEADER NAVIGASI UTAMA -->
            <div id="mainHeader" class="mb-8 border-b border-slate-200 pb-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-extrabold text-slate-800">Pusat Keuangan & Transaksi</h2>
                        <p class="text-slate-500 text-sm mt-1">Verifikasi pembayaran DP, kelola kas, dan riwayat transaksi.</p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-2 md:gap-3 w-full">
                    <button id="btnAccDp" class="nav-btn active-nav flex-1 md:flex-none border-2 border-orange-500 bg-orange-50 text-orange-700 hover:bg-orange-100 px-4 py-2 rounded-xl font-bold transition flex items-center justify-center gap-2 text-sm shadow-sm relative">
                        <i class="fa-solid fa-bell"></i> Persetujuan DP
                        {{-- Badge dari data real --}}
                        @if($jumlahPendingDp > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold border-2 border-white">{{ $jumlahPendingDp }}</span>
                        @endif
                    </button>
                    
                    <button id="btnLaporan" class="nav-btn flex-1 md:flex-none border-2 border-transparent bg-white text-slate-600 hover:bg-slate-100 hover:border-slate-200 px-4 py-2 rounded-xl font-semibold transition flex items-center justify-center gap-2 text-sm shadow-sm">
                        <i class="fa-solid fa-chart-line"></i> Laporan Arus Kas
                    </button>
                    
                    <button id="btnRiwayat" class="nav-btn flex-1 md:flex-none border-2 border-transparent bg-white text-slate-600 hover:bg-slate-100 hover:border-slate-200 px-4 py-2 rounded-xl font-semibold transition flex items-center justify-center gap-2 text-sm shadow-sm">
                        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Transaksi
                    </button>
                    
                    <button id="btnKelolaAkun" class="nav-btn flex-1 md:flex-none border-2 border-transparent bg-white text-slate-600 hover:bg-slate-100 hover:border-slate-200 px-4 py-2 rounded-xl font-semibold transition flex items-center justify-center gap-2 text-sm shadow-sm">
                        <i class="fa-solid fa-folder-open"></i> Kategori
                    </button>

                    <button id="btnTambahTransaksi" class="flex-1 md:flex-none bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl font-bold transition flex items-center justify-center gap-2 text-sm shadow-md ml-auto">
                        <i class="fa-solid fa-plus"></i> Transaksi Manual
                    </button>
                </div>
            </div>

            <!-- VIEW 1: PERSETUJUAN DP -->
            <div id="accDpView" class="view-section w-full max-w-6xl mx-auto transition-all duration-300">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-orange-50/50">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Menunggu Persetujuan DP Reservasi</h3>
                            <p class="text-xs text-slate-500">ACC data ini agar dana otomatis masuk ke Kas Pemasukan Masjid.</p>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-slate-50 text-slate-600 uppercase text-xs font-bold">
                                <tr>
                                    <th class="px-6 py-4">ID Reservasi</th>
                                    <th class="px-6 py-4">Pemohon</th>
                                    <th class="px-6 py-4">Paket Acara</th>
                                    <th class="px-6 py-4">Nominal DP</th>
                                    <th class="px-6 py-4 text-center">Bukti Bayar</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($antreanDp as $rsv)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4 font-bold text-slate-700">#RSV-{{ $rsv->id }}</td>
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-800">{{ $rsv->nama_pemohon }}</p>
                                        <p class="text-xs text-slate-500">{{ $rsv->telp_pemohon }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-800">{{ $rsv->paket }}</p>
                                        <p class="text-xs text-slate-500">{{ $rsv->tanggal }}</p>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-green-600 text-base">
                                        Rp {{ number_format($rsv->nominal_dp ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($rsv->bukti_dp)
                                            <button 
                                                data-id="{{ $rsv->id }}"
                                                data-nama="{{ $rsv->nama_pemohon }}"
                                                data-paket="{{ $rsv->paket }}"
                                                data-tanggal="{{ $rsv->tanggal }}"
                                                data-sesi="{{ $rsv->sesi }}"
                                                data-nominal="{{ number_format($rsv->nominal_dp ?? 0, 0, ',', '.') }}"
                                                data-bukti="{{ $rsv->bukti_dp }}"
                                                data-status="{{ $rsv->status_dp }}"
                                                onclick="lihatStruk(this)"
                                                class="bg-blue-100 text-blue-600 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-200 transition">
                                                Lihat Struk
                                            </button>
                                        @else
                                            <span class="text-slate-400 text-xs">Belum ada</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-2">
                                            {{-- Tombol ACC --}}
                                            <form action="{{ route('admin.keuangan.accDp', $rsv->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-green-700 shadow-sm flex items-center gap-1 transition">
                                                    <i class="fa-solid fa-check"></i> ACC & Catat Kas
                                                </button>
                                            </form>
                                            {{-- Tombol Tolak --}}
                                            <form action="{{ route('admin.keuangan.tolakDp', $rsv->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-red-50 text-red-500 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-500 hover:text-white transition">
                                                    <i class="fa-solid fa-xmark"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-slate-400 text-sm">
                                        <i class="fa-solid fa-inbox text-2xl mb-2 block"></i>
                                        Tidak ada DP yang menunggu persetujuan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- VIEW 2: LAPORAN ARUS KAS -->
            <div id="reportView" class="view-section hidden w-full max-w-5xl mx-auto transition-all duration-300">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex flex-col md:flex-row gap-4 items-center mb-6">
                    <span class="text-sm font-bold text-slate-600"><i class="fa-solid fa-filter text-green-600 mr-1"></i> Filter Laporan:</span>
                    <select id="filterBulan" class="bg-slate-50 border border-slate-300 px-4 py-2 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 w-full md:w-48">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5" {{ now()->month == 5 ? 'selected' : '' }}>Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <select id="filterTahun" class="bg-slate-50 border border-slate-300 px-4 py-2 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 w-full md:w-32">
                        <option value="2025">2025</option>
                        <option value="2026" selected>2026</option>
                    </select>
                    <button id="btnTampilkanLaporan" class="bg-slate-800 text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-slate-700 transition w-full md:w-auto">Tampilkan</button>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 md:p-12 relative overflow-hidden">
                    <i class="fa-solid fa-mosque absolute text-[200px] text-slate-50 -right-10 -bottom-10 opacity-50 pointer-events-none"></i>
                    
                    <div class="text-center border-b-2 border-slate-800 pb-4 mb-8 relative z-10">
                        <h2 class="text-2xl font-black uppercase tracking-widest text-slate-800">Laporan Arus Kas</h2>
                        <h3 class="text-lg font-bold text-slate-600 mt-1">Masjid Agung Gresik</h3>
                        <p id="labelPeriode" class="text-sm text-slate-500 mt-2 font-medium">Periode: -</p>
                    </div>

                    <div class="mb-8 relative z-10">
                        <h4 class="font-bold text-lg text-green-700 border-b border-slate-200 pb-2 mb-4 flex items-center gap-2"><i class="fa-solid fa-circle-plus text-sm"></i> PENDAPATAN (PEMASUKAN)</h4>
                        <div id="listPemasukan" class="space-y-3 px-4"></div>
                        <div class="flex justify-between items-center mt-4 px-4 py-3 bg-green-50 rounded-xl border border-green-100 font-bold text-green-800 shadow-sm">
                            <span>TOTAL PENDAPATAN</span>
                            <span id="totalPemasukan" class="text-xl tracking-wide">Rp 0</span>
                        </div>
                    </div>

                    <div class="mb-8 relative z-10">
                        <h4 class="font-bold text-lg text-red-600 border-b border-slate-200 pb-2 mb-4 flex items-center gap-2"><i class="fa-solid fa-circle-minus text-sm"></i> PENGELUARAN (BEBAN)</h4>
                        <div id="listPengeluaran" class="space-y-3 px-4"></div>
                        <div class="flex justify-between items-center mt-4 px-4 py-3 bg-red-50 rounded-xl border border-red-100 font-bold text-red-700 shadow-sm">
                            <span>TOTAL PENGELUARAN</span>
                            <span id="totalPengeluaran" class="text-xl tracking-wide">( Rp 0 )</span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center border-t-4 border-slate-800 pt-6 px-6 text-2xl font-black text-slate-800 bg-slate-50 rounded-xl py-6 mt-10 shadow-sm relative z-10">
                        <span class="mb-2 sm:mb-0">DANA BERSIH / SURPLUS</span>
                        <span id="surplus" class="text-green-600">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- VIEW 3: RIWAYAT TRANSAKSI -->
            <div id="historyView" class="view-section hidden w-full max-w-6xl mx-auto transition-all duration-300">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800">Riwayat Seluruh Transaksi</h3>
                    </div>
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-600 uppercase text-xs font-bold">
                            <tr>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Keterangan</th>
                                <th class="px-6 py-4">Jenis</th>
                                <th class="px-6 py-4">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($riwayat as $trx)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-slate-500">
                                    {{ \Carbon\Carbon::parse($trx->tanggal)->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-800">
                                    {{ $trx->kategori->nama ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 max-w-xs truncate">
                                    {{ $trx->keterangan }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($trx->jenis === 'pemasukan')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">Masuk</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">Keluar</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-bold {{ $trx->jenis === 'pemasukan' ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $trx->jenis === 'pengeluaran' ? '(' : '' }}
                                    Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                                    {{ $trx->jenis === 'pengeluaran' ? ')' : '' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-400 text-sm">
                                    <i class="fa-solid fa-inbox text-2xl mb-2 block"></i>
                                    Belum ada transaksi tercatat.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- VIEW 4: TAMBAH TRANSAKSI MANUAL -->
            <div id="formView" class="view-section hidden w-full max-w-3xl mx-auto transition-all duration-300">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Catat Transaksi Manual Baru</h2>
                    <form action="{{ route('admin.keuangan.tambah') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Transaksi <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full bg-slate-50 border border-slate-300 px-4 py-3 rounded-xl text-sm outline-none focus:ring-2 focus:ring-green-500" required />
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-slate-700 mb-3">Jenis Arus Kas <span class="text-red-500">*</span></label>
                            <div class="flex gap-4 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                <label class="flex items-center gap-2 font-bold cursor-pointer text-slate-700 hover:text-green-600">
                                    <input type="radio" name="jenis" id="radio_pemasukan" value="pemasukan" class="accent-green-600 w-5 h-5"> Dana Masuk (Pemasukan)
                                </label>
                                <label class="flex items-center gap-2 font-bold cursor-pointer text-slate-700 hover:text-red-600">
                                    <input type="radio" name="jenis" id="radio_pengeluaran" value="pengeluaran" class="accent-red-600 w-5 h-5"> Dana Keluar (Pengeluaran)
                                </label>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                            <select name="kategori_id" id="kategori_akun" class="w-full border border-slate-300 px-4 py-3 rounded-xl text-sm bg-white outline-none focus:ring-2 focus:ring-green-500" disabled required>
                                <option value="" disabled selected>Pilih jenis transaksi di atas dulu...</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Keterangan</label>
                            <input type="text" name="keterangan" placeholder="Contoh: Kotak amal Jumat minggu ke-1" class="w-full bg-slate-50 border border-slate-300 px-4 py-3 rounded-xl text-sm outline-none focus:ring-2 focus:ring-green-500" />
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nominal (Rp) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><span class="text-slate-500 font-bold font-mono">Rp</span></div>
                                <input type="number" name="nominal" class="w-full bg-slate-50 border border-slate-300 pl-12 pr-4 py-3 rounded-xl font-bold text-lg outline-none focus:ring-2 focus:ring-green-500" placeholder="0" required />
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-10 py-4 rounded-xl font-bold shadow-md shadow-green-200 transition">Simpan Transaksi Manual</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- VIEW 5: KELOLA KATEGORI AKUN -->
            <div id="accountView" class="view-section hidden w-full max-w-5xl mx-auto transition-all duration-300">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Kategori Pemasukan --}}
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                        <h4 class="font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2 flex justify-between items-center">
                            <span><i class="fa-solid fa-arrow-down text-green-600 mr-2"></i>Kategori Pendapatan</span>
                            <button onclick="document.getElementById('formKategoriPemasukan').classList.toggle('hidden')"
                                class="text-xs bg-green-50 text-green-600 px-2 py-1 rounded hover:bg-green-100 transition">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </h4>
                        {{-- Form Tambah Kategori Pemasukan --}}
                        <form id="formKategoriPemasukan" action="{{ route('admin.keuangan.tambahKategori') }}" method="POST" class="hidden mb-3 flex gap-2">
                            @csrf
                            <input type="hidden" name="jenis" value="pemasukan">
                            <input type="text" name="nama" placeholder="Nama kategori..." class="flex-1 border border-slate-300 px-3 py-2 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-500" required>
                            <button type="submit" class="bg-green-600 text-white px-3 py-2 rounded-lg text-sm font-bold">Simpan</button>
                        </form>
                        <ul class="space-y-2">
                            @foreach($kategoriPemasukan as $kat)
                            <li class="flex justify-between items-center p-2 hover:bg-slate-50 rounded border border-transparent hover:border-slate-100">
                                <span class="text-sm font-bold text-slate-600">{{ $kat->nama }}</span>
                                <form action="{{ route('admin.keuangan.hapusKategori', $kat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Kategori Pengeluaran --}}
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                        <h4 class="font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2 flex justify-between items-center">
                            <span><i class="fa-solid fa-arrow-up text-red-600 mr-2"></i>Kategori Pengeluaran</span>
                            <button onclick="document.getElementById('formKategoriPengeluaran').classList.toggle('hidden')"
                                class="text-xs bg-red-50 text-red-600 px-2 py-1 rounded hover:bg-red-100 transition">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </h4>
                        {{-- Form Tambah Kategori Pengeluaran --}}
                        <form id="formKategoriPengeluaran" action="{{ route('admin.keuangan.tambahKategori') }}" method="POST" class="hidden mb-3 flex gap-2">
                            @csrf
                            <input type="hidden" name="jenis" value="pengeluaran">
                            <input type="text" name="nama" placeholder="Nama kategori..." class="flex-1 border border-slate-300 px-3 py-2 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-500" required>
                            <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm font-bold">Simpan</button>
                        </form>
                        <ul class="space-y-2">
                            @foreach($kategoriPengeluaran as $kat)
                            <li class="flex justify-between items-center p-2 hover:bg-slate-50 rounded border border-transparent hover:border-slate-100">
                                <span class="text-sm font-bold text-slate-600">{{ $kat->nama }}</span>
                                <form action="{{ route('admin.keuangan.hapusKategori', $kat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div> 
    </main>

    <script>
        // ============================================================
        // DATA KATEGORI DARI BLADE (untuk dropdown form manual)
        // ============================================================
        const kategoriPemasukan = @json($kategoriPemasukan);
        const kategoriPengeluaran = @json($kategoriPengeluaran);

        // ============================================================
        // NAVIGASI TAB (tidak diubah sama sekali)
        // ============================================================
        const views = {
            accDp: document.getElementById('accDpView'),
            report: document.getElementById('reportView'),
            history: document.getElementById('historyView'),
            form: document.getElementById('formView'),
            account: document.getElementById('accountView')
        };
        const buttons = {
            accDp: document.getElementById('btnAccDp'),
            report: document.getElementById('btnLaporan'),
            history: document.getElementById('btnRiwayat'),
            form: document.getElementById('btnTambahTransaksi'),
            account: document.getElementById('btnKelolaAkun')
        };

        function showView(viewKey) {
            Object.values(views).forEach(v => { if(v) v.classList.add('hidden'); });
            Object.values(buttons).forEach(b => { 
                if(b && b.id !== 'btnTambahTransaksi' && b.id !== 'btnAccDp') {
                    b.classList.remove('border-green-500', 'bg-green-50', 'text-green-700');
                    b.classList.add('border-transparent', 'bg-white', 'text-slate-600');
                }
            });
            if(views[viewKey]) views[viewKey].classList.remove('hidden');
            const activeBtn = buttons[viewKey];
            if(activeBtn && activeBtn.id !== 'btnTambahTransaksi' && activeBtn.id !== 'btnAccDp') {
                activeBtn.classList.remove('border-transparent', 'bg-white', 'text-slate-600');
                activeBtn.classList.add('border-green-500', 'bg-green-50', 'text-green-700');
            }
            document.getElementById('scrollArea').scrollTop = 0;
        }

        buttons.accDp.onclick = () => showView('accDp');
        buttons.report.onclick = () => showView('report');
        buttons.history.onclick = () => showView('history');
        buttons.form.onclick = () => showView('form');
        buttons.account.onclick = () => showView('account');

        showView('accDp');

        // ============================================================
        // DROPDOWN KATEGORI DARI DATABASE (bukan hardcode lagi)
        // ============================================================
        const radioIn  = document.getElementById('radio_pemasukan');
        const radioOut = document.getElementById('radio_pengeluaran');
        const katSelect = document.getElementById('kategori_akun');

        radioIn.onchange = () => {
            katSelect.disabled = false;
            katSelect.innerHTML = kategoriPemasukan.map(k =>
                `<option value="${k.id}">${k.nama}</option>`
            ).join('');
        };

        radioOut.onchange = () => {
            katSelect.disabled = false;
            katSelect.innerHTML = kategoriPengeluaran.map(k =>
                `<option value="${k.id}">${k.nama}</option>`
            ).join('');
        };

        // ============================================================
        // LAPORAN ARUS KAS — Fetch ke controller via AJAX
        // ============================================================
        function formatRupiah(angka) {
            return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
        }

        document.getElementById('btnTampilkanLaporan').addEventListener('click', function () {
            const bulan = document.getElementById('filterBulan').value;
            const tahun = document.getElementById('filterTahun').value;

            fetch(`{{ route('admin.keuangan.laporan') }}?bulan=${bulan}&tahun=${tahun}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('labelPeriode').textContent = 'Periode: ' + data.periode;

                    // Isi list pemasukan
                    const listIn = document.getElementById('listPemasukan');
                    listIn.innerHTML = data.pemasukan.length
                        ? data.pemasukan.map(t => `
                            <div class="flex justify-between text-slate-700 border-b border-dashed border-slate-200 pb-1">
                                <span>${t.keterangan}</span>
                                <span class="font-bold text-green-600">+ ${formatRupiah(t.nominal)}</span>
                            </div>`).join('')
                        : '<p class="text-slate-400 text-sm">Tidak ada pemasukan.</p>';

                    // Isi list pengeluaran
                    const listOut = document.getElementById('listPengeluaran');
                    listOut.innerHTML = data.pengeluaran.length
                        ? data.pengeluaran.map(t => `
                            <div class="flex justify-between text-slate-700 border-b border-dashed border-slate-200 pb-1">
                                <span>${t.keterangan}</span>
                                <span class="font-bold text-red-600">( ${formatRupiah(t.nominal)} )</span>
                            </div>`).join('')
                        : '<p class="text-slate-400 text-sm">Tidak ada pengeluaran.</p>';

                    document.getElementById('totalPemasukan').textContent = formatRupiah(data.totalPemasukan);
                    document.getElementById('totalPengeluaran').textContent = '( ' + formatRupiah(data.totalPengeluaran) + ' )';

                    const surplusEl = document.getElementById('surplus');
                    surplusEl.textContent = formatRupiah(data.surplus);
                    surplusEl.className = data.surplus >= 0 ? 'text-green-600' : 'text-red-600';
                });
        });
    </script>
        <!-- MODAL STRUK -->
    <div id="modalStruk" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 relative">
            <button onclick="document.getElementById('modalStruk').style.display='none'"
                class="absolute top-4 right-4 text-slate-400 hover:text-slate-700">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
            <div class="text-center mb-6">
                <i class="fa-solid fa-receipt text-4xl text-green-600 mb-2"></i>
                <h3 class="text-xl font-bold text-slate-800">Struk Pembayaran DP</h3>
                <p class="text-xs text-slate-500">#RSV-<span id="struk_id"></span></p>
            </div>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between border-b border-dashed border-slate-200 pb-2">
                    <span class="text-slate-500">Nama Pemohon</span>
                    <span class="font-bold text-slate-800" id="struk_nama"></span>
                </div>
                <div class="flex justify-between border-b border-dashed border-slate-200 pb-2">
                    <span class="text-slate-500">Paket Acara</span>
                    <span class="font-bold text-slate-800" id="struk_paket"></span>
                </div>
                <div class="flex justify-between border-b border-dashed border-slate-200 pb-2">
                    <span class="text-slate-500">Tanggal Acara</span>
                    <span class="font-bold text-slate-800" id="struk_tanggal"></span>
                </div>
                <div class="flex justify-between border-b border-dashed border-slate-200 pb-2">
                    <span class="text-slate-500">Sesi</span>
                    <span class="font-bold text-slate-800" id="struk_sesi"></span>
                </div>
                <div class="flex justify-between border-b border-dashed border-slate-200 pb-2">
                    <span class="text-slate-500">Nominal DP</span>
                    <span class="font-bold text-green-600 text-base" id="struk_nominal"></span>
                </div>
                <div class="flex justify-between border-b border-dashed border-slate-200 pb-2">
                    <span class="text-slate-500">Status</span>
                    <span class="font-bold" id="struk_status"></span>
                </div>
                <div class="flex justify-between pb-2">
                    <span class="text-slate-500">Bukti Bayar</span>
                    <span class="font-bold text-blue-600" id="struk_bukti"></span>
                </div>
            </div>
        </div>
    </div>

    <script>
    function lihatStruk(btn) {
            document.getElementById('struk_id').textContent = btn.dataset.id;
            document.getElementById('struk_nama').textContent = btn.dataset.nama;
            document.getElementById('struk_paket').textContent = btn.dataset.paket;
            document.getElementById('struk_tanggal').textContent = btn.dataset.tanggal;
            document.getElementById('struk_sesi').textContent = btn.dataset.sesi;
            document.getElementById('struk_nominal').textContent = 'Rp ' + btn.dataset.nominal;
            document.getElementById('struk_bukti').textContent = btn.dataset.bukti;
            
            const statusEl = document.getElementById('struk_status');
            statusEl.textContent = btn.dataset.status;
            statusEl.className = btn.dataset.status === 'lunas' ? 'font-bold text-green-600' : 
                                btn.dataset.status === 'menunggu' ? 'font-bold text-orange-500' : 'font-bold text-red-500';
            
            document.getElementById('modalStruk').style.display = 'flex';
        }
    </script>
</body>
</html>