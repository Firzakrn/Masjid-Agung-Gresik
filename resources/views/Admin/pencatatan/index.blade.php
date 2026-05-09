<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Masjid | Admin Masjid</title>
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
                        @if($jumlahPendingDp > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold border-2 border-white">{{ $jumlahPendingDp }}</span>
                        @endif
                    </button>

                    <button id="btnReserver" class="nav-btn flex-1 md:flex-none border-2 border-transparent bg-white text-slate-600 hover:bg-slate-100 hover:border-slate-200 px-4 py-2 rounded-xl font-semibold transition flex items-center justify-center gap-2 text-sm shadow-sm">
                        <i class="fa-solid fa-file-invoice"></i> Data Reserver
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

            <!-- VIEW 1: ACC DP -->
            <div id="accDpView" class="view-section w-full max-w-6xl mx-auto transition-all duration-300">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-orange-50/50">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Menunggu Persetujuan DP Reservasi</h3>
                            <p class="text-xs text-slate-500">ACC data ini agar dana otomatis masuk ke Kas Pemasukan Masjid.</p>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[900px] text-left text-sm">
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
                                            <form action="{{ route('admin.keuangan.accDp', $rsv->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-green-700 shadow-sm flex items-center gap-1 transition">
                                                    <i class="fa-solid fa-check"></i> ACC & Catat Kas
                                                </button>
                                            </form>
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

            <!-- INCLUDES UNTUK VIEW LAINNYA -->
            {{-- Bagian ini memanggil file blade lain yang ada di folder pencatatan --}}
            <div id="reserverView" class="view-section hidden w-full transition-all duration-300">
                @include('admin.pencatatan.reserver')
            </div>

            <div id="reportView" class="view-section hidden w-full transition-all duration-300">
                @include('admin.pencatatan.laporan')
            </div>

            <div id="historyView" class="view-section hidden w-full transition-all duration-300">
                @include('admin.pencatatan.riwayat')
            </div>

            <div id="formView" class="view-section hidden w-full transition-all duration-300">
                @include('admin.pencatatan.tambah')
            </div>

            <div id="accountView" class="view-section hidden w-full transition-all duration-300">
                @include('admin.pencatatan.akun') 
            </div>

        </div>
    </main>

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

    <!-- MODAL DETAIL RESERVER (Diperbarui dengan Layout 2 Kolom) -->
    <div id="modalDetailReserver" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex-col items-center justify-center p-4 sm:p-6 opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-6xl max-h-[95vh] flex flex-col overflow-hidden scale-95 transition-transform duration-300" id="modalDetailContent">
            
            <!-- Header Modal -->
            <div class="bg-slate-800 text-white p-5 flex justify-between items-center flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 p-2 rounded-lg"><i class="fa-solid fa-file-invoice text-xl"></i></div>
                    <div>
                        <h3 class="font-bold text-lg leading-tight">Detail Formulir & Pembayaran Reservasi</h3>
                        <p class="text-xs text-slate-300">Informasi lengkap pemohon, syarat acara, dan pelacakan kas.</p>
                    </div>
                </div>
                <button onclick="tutupModalReserver()" class="text-slate-300 hover:text-white bg-white/10 hover:bg-white/20 w-8 h-8 rounded-full flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Body Modal -->
            <div class="p-6 overflow-y-auto bg-slate-50 flex-1 hide-scroll-bar">
                
                <!-- 4 KOTAK STATUS ATAS -->
                <div class="flex flex-wrap gap-4 mb-6 bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex-1">
                        <p class="text-[10px] uppercase font-bold text-slate-400">Status Reservasi</p>
                        <p class="font-bold text-slate-800 text-sm" id="det_status">-</p>
                    </div>
                    <div class="flex-1 border-l border-slate-100 pl-4">
                        <p class="text-[10px] uppercase font-bold text-slate-400">Status Pembayaran</p>
                        <p class="font-bold text-sm uppercase" id="det_status_dp">-</p>
                    </div>
                    <div class="flex-1 border-l border-slate-100 pl-4">
                        <p class="text-[10px] uppercase font-bold text-slate-400">Total Terbayar</p>
                        <p class="font-bold text-green-600 text-sm" id="det_total_terbayar">-</p>
                    </div>
                    <div class="flex-1 border-l border-slate-100 pl-4">
                        <p class="text-[10px] uppercase font-bold text-slate-400">Sisa Tagihan / Kurang</p>
                        <p class="font-bold text-red-500 text-sm" id="det_sisa_tagihan">-</p>
                    </div>
                </div>

                <!-- LAYOUT 2 KOLOM -->
                <div class="flex flex-col lg:flex-row gap-6">
                    
                    <!-- KOLOM KIRI: Data Acara, Pemohon, Dokumen -->
                    <div class="lg:w-2/3 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                <h4 class="font-bold text-sm text-blue-600 border-b border-slate-100 pb-2 mb-3"><i class="fa-solid fa-calendar-check mr-2"></i>Informasi Acara</h4>
                                <table class="w-full text-sm">
                                    <tr><td class="py-1.5 text-slate-500 w-1/3">Paket</td><td class="py-1.5 font-semibold text-slate-800" id="det_paket">-</td></tr>
                                    <tr><td class="py-1.5 text-slate-500">Tanggal</td><td class="py-1.5 font-semibold text-slate-800" id="det_tanggal">-</td></tr>
                                    <tr><td class="py-1.5 text-slate-500">Sesi</td><td class="py-1.5 font-semibold text-slate-800" id="det_sesi">-</td></tr>
                                </table>
                            </div>
                            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                <h4 class="font-bold text-sm text-blue-600 border-b border-slate-100 pb-2 mb-3"><i class="fa-solid fa-user-pen mr-2"></i>Data Pemohon</h4>
                                <table class="w-full text-sm">
                                    <tr><td class="py-1.5 text-slate-500 w-1/3">Nama</td><td class="py-1.5 font-semibold text-slate-800" id="det_nama_pemohon">-</td></tr>
                                    <tr><td class="py-1.5 text-slate-500">Telepon</td><td class="py-1.5 font-semibold text-slate-800" id="det_telp_pemohon">-</td></tr>
                                    <tr><td class="py-1.5 text-slate-500 align-top">Alamat</td><td class="py-1.5 font-semibold text-slate-800" id="det_alamat_pemohon">-</td></tr>
                                </table>
                            </div>
                            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                <h4 class="font-bold text-sm text-pink-600 border-b border-slate-100 pb-2 mb-3"><i class="fa-solid fa-mars mr-2"></i>Pengantin Pria</h4>
                                <table class="w-full text-sm">
                                    <tr><td class="py-1.5 text-slate-500 w-1/3">Nama CPP</td><td class="py-1.5 font-semibold text-slate-800" id="det_nama_cpp">-</td></tr>
                                    <tr><td class="py-1.5 text-slate-500">Telepon</td><td class="py-1.5 font-semibold text-slate-800" id="det_telp_cpp">-</td></tr>
                                </table>
                            </div>
                            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                <h4 class="font-bold text-sm text-pink-600 border-b border-slate-100 pb-2 mb-3"><i class="fa-solid fa-venus mr-2"></i>Pengantin Wanita</h4>
                                <table class="w-full text-sm">
                                    <tr><td class="py-1.5 text-slate-500 w-1/3">Nama CPW</td><td class="py-1.5 font-semibold text-slate-800" id="det_nama_cpw">-</td></tr>
                                    <tr><td class="py-1.5 text-slate-500">Telepon</td><td class="py-1.5 font-semibold text-slate-800" id="det_telp_cpw">-</td></tr>
                                </table>
                            </div>
                        </div>

                        <!-- DOKUMEN SYARAT RESERVASI -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                            <h4 class="font-bold text-sm text-purple-600 border-b border-slate-100 pb-2 mb-4"><i class="fa-solid fa-folder-open mr-2"></i>Lampiran Dokumen Persyaratan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                                    <span class="text-xs font-semibold text-slate-700">Surat Rekomendasi KUA</span>
                                    <div id="doc_kua"></div>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                                    <span class="text-xs font-semibold text-slate-700">KTP Pria (CPP)</span>
                                    <div id="doc_ktp_cpp"></div>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                                    <span class="text-xs font-semibold text-slate-700">KTP Wanita (CPW)</span>
                                    <div id="doc_ktp_cpw"></div>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                                    <span class="text-xs font-semibold text-slate-700">Foto Pria 3x4</span>
                                    <div id="doc_foto_cpp"></div>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                                    <span class="text-xs font-semibold text-slate-700">Foto Wanita 3x4</span>
                                    <div id="doc_foto_cpw"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: Riwayat Transaksi -->
                    <div class="lg:w-1/3">
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm sticky top-0">
                            <h4 class="font-bold text-sm text-green-700 border-b border-slate-100 pb-2 mb-4">
                                <i class="fa-solid fa-money-bill-transfer mr-2"></i>Riwayat Pembayaran Jamaah
                            </h4>
                            
                            <!-- Area Injeksi JS -->
                            <div id="list_riwayat_transaksi" class="space-y-3 mb-6 max-h-[300px] overflow-y-auto pr-2 hide-scroll-bar">
                                <!-- List transaksi akan di-generate oleh JS -->
                            </div>

                            <div class="bg-slate-800 text-white p-4 rounded-xl">
                                <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">TOTAL BIAYA SEWA</p>
                                <p class="text-xl font-black" id="det_grand_total">Rp 0</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="p-4 bg-white border-t border-slate-200 flex justify-end items-center">
                <button onclick="tutupModalReserver()" class="bg-slate-800 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-700 transition">Tutup Modal</button>
            </div>
        </div>
    </div>

    <!-- SCRIPT UTAMA UNTUK NAVIGASI INDEX -->
    <script>
        const views = {
            accDp: document.getElementById('accDpView'),
            reserver: document.getElementById('reserverView'),
            report: document.getElementById('reportView'),
            history: document.getElementById('historyView'),
            form: document.getElementById('formView'),
            account: document.getElementById('accountView')
        };
        
        const buttons = {
            accDp: document.getElementById('btnAccDp'),
            reserver: document.getElementById('btnReserver'),
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
        buttons.reserver.onclick = () => showView('reserver');
        buttons.report.onclick = () => showView('report');
        buttons.history.onclick = () => showView('history');
        buttons.form.onclick = () => showView('form');
        buttons.account.onclick = () => showView('account');

        // View default saat halaman dimuat
        showView('accDp');

        // Fungsi Modal Struk (Milik ACC DP View)
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

        // ============================================================
        // FUNGSI UNTUK MEMBUKA DAN MENUTUP MODAL RESERVER
        // ============================================================
        function bukaModalReserver(btn) {
            const data = JSON.parse(btn.getAttribute('data-rsv'));
            
            let grandTotal = parseFloat(data.grand_total || 0);
            let totalTerbayar = 0;
            let htmlTransaksi = '';

            // 1. OLAH DATA TRANSAKSI & HITUNG TERBAYAR
            if (data.transaksis && data.transaksis.length > 0) {
                // Filter hanya yang pemasukan
                let pemasukan = data.transaksis.filter(trx => trx.jenis === 'pemasukan');
                
                if (pemasukan.length > 0) {
                    pemasukan.forEach(trx => {
                        totalTerbayar += parseFloat(trx.nominal);
                        
                        // Konversi string tanggal ke format yang lebih rapi (opsional)
                        let tgl = new Date(trx.tanggal).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year:'numeric'});

                        htmlTransaksi += `
                            <div class="flex justify-between items-center border-b border-dashed border-slate-200 py-2">
                                <div>
                                    <p class="text-xs font-bold text-slate-700">${trx.keterangan}</p>
                                    <p class="text-[10px] text-slate-400">${tgl}</p>
                                </div>
                                <p class="text-sm font-bold text-green-600">+ ${formatRupiah(trx.nominal)}</p>
                            </div>
                        `;
                    });
                } else {
                    htmlTransaksi = '<p class="text-xs text-slate-400 italic text-center py-4">Belum ada pembayaran lunas.</p>';
                }
            } else {
                htmlTransaksi = '<p class="text-xs text-slate-400 italic text-center py-4">Belum ada riwayat tercatat.</p>';
            }

            // Hitung sisa
            let sisaTagihan = Math.max(0, grandTotal - totalTerbayar);

            // 2. PENENTUAN STATUS PEMBAYARAN DINAMIS
            let statusBayarText = 'BELUM BAYAR';
            let statusBayarColor = 'text-red-500';

            if (totalTerbayar >= grandTotal && grandTotal > 0) {
                statusBayarText = 'SELESAI (LUNAS)';
                statusBayarColor = 'text-green-600';
            } else if (totalTerbayar > 0) {
                statusBayarText = 'LUNAS DP (NYICIL)';
                statusBayarColor = 'text-orange-500';
            }

            // Memasukkan Teks Status Atas
            document.getElementById('det_status').textContent = data.status || '-';
            let elStatusDp = document.getElementById('det_status_dp');
            elStatusDp.textContent = statusBayarText;
            elStatusDp.className = `font-bold text-sm uppercase ${statusBayarColor}`;

            document.getElementById('det_total_terbayar').textContent = formatRupiah(totalTerbayar);
            document.getElementById('det_sisa_tagihan').textContent = formatRupiah(sisaTagihan);
            document.getElementById('det_grand_total').textContent = formatRupiah(grandTotal);

            // Memasukkan HTML Riwayat Transaksi ke Kolom Kanan
            document.getElementById('list_riwayat_transaksi').innerHTML = htmlTransaksi;

            // Info Acara & Pemohon
            document.getElementById('det_paket').textContent = data.paket || '-';
            document.getElementById('det_tanggal').textContent = data.tanggal || '-';
            document.getElementById('det_sesi').textContent = data.sesi || '-';
            document.getElementById('det_nama_pemohon').textContent = data.nama_pemohon || '-';
            document.getElementById('det_telp_pemohon').textContent = data.telp_pemohon || '-';
            document.getElementById('det_alamat_pemohon').textContent = data.alamat_pemohon || '-';
            document.getElementById('det_nama_cpp').textContent = data.nama_cpp || '-';
            document.getElementById('det_telp_cpp').textContent = data.telp_cpp || '-';
            document.getElementById('det_nama_cpw').textContent = data.nama_cpw || '-';
            document.getElementById('det_telp_cpw').textContent = data.telp_cpw || '-';

            // 3. GENERATE TOMBOL DOKUMEN
            // Asumsi file disimpan di folder 'storage', ubah jika kamu simpannya di 'public/images' dll.
            const renderDocBtn = (path, namaFile) => {
                if (!path) return `<span class="text-[10px] text-red-400 font-bold bg-red-50 px-2 py-1 rounded">Belum Upload</span>`;
                return `<a href="/storage/${path}" target="_blank" class="text-[10px] font-bold bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded-md transition shadow-sm"><i class="fa-solid fa-eye mr-1"></i>Lihat Dokumen</a>`;
            };

            document.getElementById('doc_kua').innerHTML = renderDocBtn(data.surat_rekomendasi, 'Surat KUA');
            document.getElementById('doc_ktp_cpp').innerHTML = renderDocBtn(data.foto_ktp_cpp, 'KTP Pria');
            document.getElementById('doc_ktp_cpw').innerHTML = renderDocBtn(data.foto_ktp_cpw, 'KTP Wanita');
            document.getElementById('doc_foto_cpp').innerHTML = renderDocBtn(data.foto_cpp_3x4, 'Foto Pria');
            document.getElementById('doc_foto_cpw').innerHTML = renderDocBtn(data.foto_cpw_3x4, 'Foto Wanita');

            // Animasi memunculkan modal
            const modal = document.getElementById('modalDetailReserver');
            const content = document.getElementById('modalDetailContent');
            modal.classList.remove('hidden');
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
            }, 10);
        }

        function tutupModalReserver() {
            const modal = document.getElementById('modalDetailReserver');
            const content = document.getElementById('modalDetailContent');
            modal.classList.add('opacity-0');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }, 300);
        }
        
        // Fungsi pembantu global (format rupiah) yang dipakai di banyak sub-view
        function formatRupiah(angka) {
            return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
        }
    </script>

    <!-- STACK UNTUK SCRIPT DARI FILE BLADE LAIN -->
    @stack('scripts')

</body>
</html>