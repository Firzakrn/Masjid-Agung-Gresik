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
        .hide-scroll-bar::-webkit-scrollbar { display: none; }
        .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col">

    <div class="bg-green-700 text-white p-6 shadow-md">
        <div class="max-w-5xl mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-bold">Dasboard {{ Auth::user()->name }}</h1>
            <a href="{{ url('/') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm font-semibold transition">
                <i class="fa-solid fa-home mr-1"></i> Beranda
            </a>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-10 w-full flex-grow" x-data="{ activeTab: 'reservasi' }">
        
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-slate-800 mb-2">Riwayat & Status</h2>
            <p class="text-slate-500">Pantau proses reservasi acara dan penyaluran ZIS Anda.</p>
        </div>

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
                                
                                <div class="flex items-center gap-2">
                                    
                                    <div>
                                        @if(stripos($rs->status, 'Tanggal Dikonfirmasi') !== false)
                                            <span class="bg-blue-100 text-blue-700 border border-blue-200 text-xs font-bold px-3 py-1.5 rounded-lg text-center block">
                                                <i class="fa-solid fa-calendar-check mr-1"></i> Tgl Tersedia
                                            </span>
                                        @elseif(stripos($rs->status, 'Ditolak') !== false)
                                            <span class="bg-red-100 text-red-700 border border-red-200 text-xs font-bold px-3 py-1.5 rounded-lg text-center block">
                                                <i class="fa-solid fa-ban mr-1"></i> {{ $rs->status }}
                                            </span>
                                        @elseif(stripos($rs->status, 'Menunggu') !== false)
                                            <span class="bg-yellow-100 text-yellow-700 border border-yellow-200 text-xs font-bold px-3 py-1.5 rounded-lg text-center block">
                                                {{ $rs->status }}
                                            </span>
                                        @elseif(strtolower($rs->status) === 'lunas' || strtolower($rs->status_dp) === 'lunas')
                                            <span class="bg-green-100 text-green-700 border border-green-200 text-xs font-bold px-3 py-1.5 rounded-lg text-center block">
                                                ✓ Lunas
                                            </span>
                                        @elseif(stripos($rs->status, 'Selesai') !== false)
                                            <span class="bg-green-100 text-green-700 border border-green-200 text-xs font-bold px-3 py-1.5 rounded-lg text-center block">
                                                {{ $rs->status }}
                                            </span>
                                        @else
                                            <span class="bg-slate-100 text-slate-600 border border-slate-200 text-xs font-bold px-3 py-1.5 rounded-lg text-center block">
                                                {{ $rs->status }}
                                            </span>
                                        @endif
                                    </div>

                                    <button type="button" 
                                        onclick="bukaModalReserver(this)" 
                                        data-rsv="{{ json_encode($rs) }}"
                                        title="Lihat Detail Reservasi"
                                        class="bg-slate-800 text-white hover:bg-slate-700 w-8 h-8 rounded-lg flex items-center justify-center transition shadow-sm flex-shrink-0">
                                        <i class="fa-solid fa-file-invoice"></i>
                                    </button>
                                </div>
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

                            @if($rs->status === 'Tanggal Dikonfirmasi - Silakan Lanjut Isi Formulir')
                                <a href="{{ route('reservasi.formulir', ['id' => $rs->id, 'paket' => $rs->paket, 'tanggal' => $rs->tanggal, 'sesi' => $rs->sesi]) }}" class="block w-full text-center bg-blue-600 text-white hover:bg-blue-700 font-bold py-3 rounded-xl transition shadow-sm mt-4">
                                    <i class="fa-solid fa-file-pen mr-1"></i> Lanjut Pesan
                                </a>
                            @endif

                            @if(stripos($rs->status, 'Menunggu Pembayaran DP') !== false)
                                <a href="{{ route('reservasi.pembayaran', $rs->id) }}" class="block w-full text-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-bold py-3 rounded-xl transition border border-blue-200 hover:border-transparent mt-4">
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
    <!-- MODAL LIHAT DETAIL/STRUK -->
    <div id="modalDetailReserver" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex-col items-center justify-center p-4 sm:p-6 opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-6xl max-h-[95vh] flex flex-col overflow-hidden scale-95 transition-transform duration-300" id="modalDetailContent">
            
            <div class="bg-slate-800 text-white p-5 flex justify-between items-center flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 p-2 rounded-lg"><i class="fa-solid fa-file-invoice text-xl"></i></div>
                    <div>
                        <h3 class="font-bold text-lg leading-tight">Detail Formulir & Pembayaran Reservasi</h3>
                        <p class="text-xs text-slate-300">Rincian data acara dan pelacakan kas Anda.</p>
                    </div>
                </div>
                <button onclick="tutupModalReserver()" class="text-slate-300 hover:text-white bg-white/10 hover:bg-white/20 w-8 h-8 rounded-full flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto bg-slate-50 flex-1 hide-scroll-bar">
                
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
                        <p class="text-[10px] uppercase font-bold text-slate-400">Sisa Tagihan</p>
                        <p class="font-bold text-red-500 text-sm" id="det_sisa_tagihan">-</p>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-6">
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
                                    <tr><td class="py-1.5 text-slate-500 align-top">Memo</td><td class="py-1.5 font-semibold text-slate-800" id="det_memo_pemohon">-</td></tr>
                                </table>
                            </div>
                            <div id="card_cpp" class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                <h4 class="font-bold text-sm text-pink-600 border-b border-slate-100 pb-2 mb-3"><i class="fa-solid fa-mars mr-2"></i>Pengantin Pria</h4>
                                <table class="w-full text-sm">
                                    <tr><td class="py-1.5 text-slate-500 w-1/3">Nama CPP</td><td class="py-1.5 font-semibold text-slate-800" id="det_nama_cpp">-</td></tr>
                                    <tr><td class="py-1.5 text-slate-500">Telepon</td><td class="py-1.5 font-semibold text-slate-800" id="det_telp_cpp">-</td></tr>
                                </table>
                            </div>
                            <div id="card_cpw" class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                <h4 class="font-bold text-sm text-pink-600 border-b border-slate-100 pb-2 mb-3"><i class="fa-solid fa-venus mr-2"></i>Pengantin Wanita</h4>
                                <table class="w-full text-sm">
                                    <tr><td class="py-1.5 text-slate-500 w-1/3">Nama CPW</td><td class="py-1.5 font-semibold text-slate-800" id="det_nama_cpw">-</td></tr>
                                    <tr><td class="py-1.5 text-slate-500">Telepon</td><td class="py-1.5 font-semibold text-slate-800" id="det_telp_cpw">-</td></tr>
                                </table>
                            </div>
                        </div>

                        <div id="card_lampiran" class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
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

                    <div class="lg:w-1/3">
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm sticky top-0">
                            <h4 class="font-bold text-sm text-green-700 border-b border-slate-100 pb-2 mb-4">
                                <i class="fa-solid fa-money-bill-transfer mr-2"></i>Riwayat Pembayaran
                            </h4>
                            <div id="list_riwayat_transaksi" class="space-y-3 mb-6 max-h-[300px] overflow-y-auto pr-2 hide-scroll-bar"></div>
                            <div class="bg-slate-800 text-white p-4 rounded-xl">
                                <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">TOTAL BIAYA SEWA</p>
                                <p class="text-xl font-black" id="det_grand_total">Rp 0</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="p-4 bg-white border-t border-slate-200 flex justify-end items-center">
                <button onclick="tutupModalReserver()" class="bg-slate-800 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-700 transition">Tutup</button>
            </div>
        </div>
    </div>
    <script>
        function bukaModalReserver(btn) {
            const data = JSON.parse(btn.getAttribute('data-rsv'));
            
            let totalTerbayar = 0;
            let htmlTransaksi = '';

            if (data.transaksis && data.transaksis.length > 0) {
                let pemasukan = data.transaksis.filter(trx => trx.jenis === 'pemasukan');
                
                if (pemasukan.length > 0) {
                    pemasukan.forEach(trx => {
                        totalTerbayar += parseFloat(trx.nominal);
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
                    htmlTransaksi = '<p class="text-xs text-slate-400 italic text-center py-4">Belum ada pembayaran masuk.</p>';
                }
            } else {
                htmlTransaksi = '<p class="text-xs text-slate-400 italic text-center py-4">Belum ada pembayaran tercatat.</p>';
            }

            let grandTotal = parseFloat(data.grand_total || 0);
            if (grandTotal === 0) {
                const pkt = (data.paket || '').toLowerCase();
                if (pkt.includes('intimate wedding'))   grandTotal = 2500000;
                else if (pkt.includes('wedding'))       grandTotal = 12500000;
                else if (pkt.includes('akad'))          grandTotal = 3000000;
                else                                    grandTotal = 7500000;
            }

            let sisaTagihan = Math.max(0, grandTotal - totalTerbayar);
            let statusBayarText = 'BELUM BAYAR';
            let statusBayarColor = 'text-red-500';

            if (grandTotal > 0 && totalTerbayar >= grandTotal) {
                statusBayarText = 'LUNAS';
                statusBayarColor = 'text-green-600';
            } else if (totalTerbayar > 0) {
                statusBayarText = 'SEBAGIAN (DP)';
                statusBayarColor = 'text-orange-500';
            }

            document.getElementById('det_status').textContent = data.status || '-';
            let elStatusDp = document.getElementById('det_status_dp');
            elStatusDp.textContent = statusBayarText;
            elStatusDp.className = `font-bold text-sm uppercase ${statusBayarColor}`;
            document.getElementById('det_total_terbayar').textContent = formatRupiah(totalTerbayar);
            document.getElementById('det_sisa_tagihan').textContent = formatRupiah(sisaTagihan);
            document.getElementById('det_grand_total').textContent = formatRupiah(grandTotal);
            document.getElementById('list_riwayat_transaksi').innerHTML = htmlTransaksi;
            document.getElementById('det_paket').textContent = data.paket || '-';
            document.getElementById('det_tanggal').textContent = data.tanggal || '-';
            document.getElementById('det_sesi').textContent = data.sesi || '-';
            document.getElementById('det_nama_pemohon').textContent = data.nama_pemohon || '-';
            document.getElementById('det_telp_pemohon').textContent = data.telp_pemohon || '-';
            document.getElementById('det_alamat_pemohon').textContent = data.alamat_pemohon || '-';
            document.getElementById('det_memo_pemohon').textContent = data.memo_pemohon || '-';

            const paketLower = (data.paket || '').toLowerCase();
            const isPernikahan = paketLower.includes('wedding') || paketLower.includes('akad');
            
            document.getElementById('card_cpp').style.display = isPernikahan ? 'block' : 'none';
            document.getElementById('card_cpw').style.display = isPernikahan ? 'block' : 'none';
            document.getElementById('card_lampiran').style.display = isPernikahan ? 'block' : 'none';

            if (isPernikahan) {
                document.getElementById('det_nama_cpp').textContent = data.nama_cpp || '-';
                document.getElementById('det_telp_cpp').textContent = data.telp_cpp || '-';
                document.getElementById('det_nama_cpw').textContent = data.nama_cpw || '-';
                document.getElementById('det_telp_cpw').textContent = data.telp_cpw || '-';
            }

            const renderDocBtn = (path) => {
                if (!path) return `<span class="text-[10px] text-red-400 font-bold bg-red-50 px-2 py-1 rounded">Belum Upload</span>`;
                return `<a href="/storage/${path}" target="_blank" class="text-[10px] font-bold bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded-md transition shadow-sm"><i class="fa-solid fa-eye mr-1"></i>Lihat Dokumen</a>`;
            };
            
            document.getElementById('doc_kua').innerHTML = renderDocBtn(data.surat_rekomendasi);
            document.getElementById('doc_ktp_cpp').innerHTML = renderDocBtn(data.foto_ktp_cpp);
            document.getElementById('doc_ktp_cpw').innerHTML = renderDocBtn(data.foto_ktp_cpw);
            document.getElementById('doc_foto_cpp').innerHTML = renderDocBtn(data.foto_cpp_3x4);
            document.getElementById('doc_foto_cpw').innerHTML = renderDocBtn(data.foto_cpw_3x4);

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

        function formatRupiah(angka) {
            return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
        }
    </script>
</body>
</html>