<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran & Fasilitas - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Snap.js Midtrans --}}
    @if(config('midtrans.is_production'))
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endif

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">

    <div class="max-w-6xl mx-auto px-4 py-12">

        {{-- PROGRESS BAR --}}
        <div class="flex items-center justify-center gap-2 md:gap-6 mb-12 overflow-x-auto pb-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center"><i class="fa-solid fa-check text-sm"></i></div>
                <div class="hidden md:block"><p class="text-sm font-bold text-slate-800">Penjadwalan</p></div>
            </div>
            <div class="w-6 md:w-12 h-0.5 bg-blue-600"></div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center"><i class="fa-solid fa-check text-sm"></i></div>
                <div class="hidden md:block"><p class="text-sm font-bold text-slate-800">Login</p></div>
            </div>
            <div class="w-6 md:w-12 h-0.5 bg-blue-600"></div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center"><i class="fa-solid fa-check text-sm"></i></div>
                <div class="hidden md:block"><p class="text-sm font-bold text-slate-800">Formulir Data</p></div>
            </div>
            <div class="w-6 md:w-12 h-0.5 bg-blue-600"></div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 border border-blue-200 font-bold flex items-center justify-center text-lg shadow-sm">4</div>
                <div class="hidden md:block"><p class="text-sm font-bold text-slate-800">Pembayaran</p></div>
            </div>
        </div>

        {{-- FORM UTAMA DENGAN ALPINE JS --}}
        <div x-data="pembayaranForm()" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            {{-- KOLOM KIRI: FASILITAS & TOMBOL BAYAR --}}
            <div class="lg:col-span-8 space-y-8">

                {{-- BLOK FASILITAS TAMBAHAN --}}
                <div x-data="{ openFasilitas: false }" class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
                    <button type="button" @click="openFasilitas = !openFasilitas" class="w-full bg-blue-50 hover:bg-blue-100 transition p-6 md:px-10 border-b border-blue-100 flex items-center justify-between focus:outline-none">
                        <div class="flex items-center gap-4 text-left">
                            <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl shadow-md flex-shrink-0">
                                <i class="fa-solid fa-couch"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-800">Fasilitas Tambahan (Opsional)</h2>
                                <p class="text-sm text-slate-500">Sesuaikan kebutuhan acara Anda.</p>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-blue-200 flex items-center justify-center text-blue-700 flex-shrink-0">
                            <svg :class="openFasilitas ? 'rotate-180' : ''" class="w-6 h-6 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>

                    <div x-show="openFasilitas" class="p-6 md:p-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <template x-for="(item, index) in daftarFasilitas" :key="index">
                                <div class="flex justify-between items-center p-4 bg-white border border-slate-200 rounded-2xl shadow-sm hover:border-blue-300 transition">
                                    <div>
                                        <p class="font-bold text-sm text-slate-700" x-text="item.nama"></p>
                                        <p class="text-xs font-semibold text-blue-600" x-text="formatRupiah(item.harga) + item.satuan"></p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <button type="button" @click="if(item.qty > 0) item.qty--" class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition focus:outline-none">
                                            <i class="fa-solid fa-minus text-xs"></i>
                                        </button>
                                        <span class="w-6 text-center font-bold text-slate-800 text-sm" x-text="item.qty"></span>
                                        <button type="button" @click="item.qty++" class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center hover:bg-blue-200 transition focus:outline-none">
                                            <i class="fa-solid fa-plus text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- BLOK TOMBOL BAYAR MIDTRANS & MANUAL --}}
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 p-8 md:p-10">
                    
                    {{-- OPSI 1: MIDTRANS OTOMATIS --}}
                    <h2 class="text-xl font-bold text-slate-800 mb-2">Opsi 1: Pembayaran Otomatis</h2>
                    <p class="text-sm text-slate-500 mb-6">Diproses seketika via Midtrans (Tersedia Transfer Bank, E-Wallet, Kartu Kredit).</p>

                    {{-- Logo metode pembayaran --}}
                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="px-3 py-1 bg-slate-100 rounded-lg text-xs font-semibold text-slate-600">Virtual Account</span>
                        <span class="px-3 py-1 bg-green-100 rounded-lg text-xs font-semibold text-green-700">GoPay</span>
                        <span class="px-3 py-1 bg-purple-100 rounded-lg text-xs font-semibold text-purple-700">OVO</span>
                        <span class="px-3 py-1 bg-blue-100 rounded-lg text-xs font-semibold text-blue-700">ShopeePay</span>
                    </div>

                    {{-- Alert error --}}
                    <div x-show="errorMsg" x-cloak class="mb-4 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm" x-text="errorMsg"></div>

                    <div class="flex justify-between items-center mb-8">
                        <a href="{{ url()->previous() }}" class="flex items-center gap-2 text-slate-400 font-bold hover:text-slate-600 transition">
                            <i class="fa-solid fa-chevron-left text-xl"></i> Kembali
                        </a>

                        {{-- Tombol Bayar via Midtrans --}}
                        <button
                            type="button"
                            @click="bayarMidtrans()"
                            :disabled="loading"
                            class="bg-green-600 text-white font-bold py-3 px-6 rounded-2xl hover:bg-green-700 transition shadow-lg shadow-green-200 flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed"
                        >
                            <span x-show="!loading">Bayar Otomatis <i class="fa-solid fa-bolt ml-1"></i></span>
                            <span x-show="loading" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                                Memproses...
                            </span>
                        </button>
                    </div>

                    {{-- OPSI 2: QRIS STATIS MASJID --}}
                    <div class="pt-8 border-t border-slate-200">
                        <h2 class="text-xl font-bold text-slate-800 mb-2">Opsi 2: Transfer Manual / QRIS Masjid</h2>
                        <p class="text-sm text-slate-500 mb-6">Jika opsi otomatis bermasalah, silakan transfer ke rekening masjid atau scan QRIS di bawah ini.</p>
                        
                        <div class="flex flex-col md:flex-row gap-6 items-center bg-slate-50 p-6 rounded-2xl border border-slate-200">
                            <!-- GAMBAR QRIS STATIS & TOMBOL DOWNLOAD -->
                            <div class="flex flex-col items-center gap-3">
                                <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-200">
                                    <img src="{{ asset('images/qris.jpeg') }}" alt="QRIS Masjid Agung Gresik" class="w-40 h-40 object-cover rounded-lg">
                                </div>
                                <!-- Tombol Download QRIS -->
                                <a href="{{ asset('images/qris.jpeg') }}" download="QRIS_Masjid_Agung_Gresik.png" class="text-xs font-bold text-blue-600 hover:text-blue-800 bg-blue-100 hover:bg-blue-200 px-4 py-2 rounded-full transition flex items-center gap-1">
                                    <i class="fa-solid fa-download"></i> Download QRIS
                                </a>
                            </div>
                            
                            <!-- INSTRUKSI MANUAL & TOMBOL WA -->
                            <div class="flex-1 w-full">
                                <p class="text-sm text-slate-700 font-bold mb-2">Instruksi Pembayaran Manual:</p>
                                <ul class="list-decimal list-inside text-sm text-slate-600 space-y-1 mb-4">
                                    <li>Buka aplikasi m-Banking / E-Wallet Anda.</li>
                                    <li>Scan QRIS di samping atau hasil download.</li>
                                    <li>Masukkan nominal tepat: <span class="font-bold text-green-700">Rp {{ number_format($dp, 0, ',', '.') }}</span></li>
                                    <li>Kirim bukti transfer ke WhatsApp Admin.</li>
                                </ul>

                                <!-- Tombol Konfirmasi WA -->
                                @php
                                    // Nomor WA Admin (gunakan kode negara 62 tanpa + atau 0)
                                    $noWaAdmin = "6281216978686"; 
                                    
                                    // Pesan yang sudah di-format otomatis
                                    $pesanWa = "Assalamualaikum Admin,\nSaya ingin konfirmasi pembayaran DP Reservasi.\n\n*Nama:* " . $reservasi->nama_pemohon . "\n*Paket:* " . $reservasi->paket . "\n*Tanggal Acara:* " . $reservasi->tanggal . "\n*Nominal:* Rp " . number_format($dp, 0, ',', '.') . "\n\nBerikut saya lampirkan bukti transfernya.";
                                    $linkWa = "https://wa.me/" . $noWaAdmin . "?text=" . urlencode($pesanWa);
                                @endphp

                                <a href="{{ $linkWa }}" target="_blank" onclick="tutupOtomatis()" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-[#25D366] hover:bg-[#1ebd5a] text-white font-bold py-2.5 px-5 rounded-xl transition shadow-md shadow-green-200 mb-4">
                                    <i class="fa-brands fa-whatsapp text-lg"></i> Konfirmasi via WhatsApp
                                </a>

                                <div class="bg-blue-50 text-blue-700 text-xs p-3 rounded-lg border border-blue-100 flex gap-2 items-start mt-2">
                                    <i class="fa-solid fa-circle-info mt-0.5"></i>
                                    <p>Setelah Admin mengecek bukti transfer dan menekan tombol ACC, halaman ini akan otomatis berpindah (Jangan di-refresh).</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-slate-400 mt-8 text-center">
                        <i class="fa-solid fa-shield-halved mr-1"></i>
                        Semua transaksi tercatat resmi dalam sistem keuangan Masjid Agung Gresik.
                    </p>
                </div>
            </div>

            {{-- KOLOM KANAN: STRUK REAL-TIME --}}
            <div class="lg:col-span-4">
                <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-slate-100 sticky top-10 relative overflow-hidden">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Ringkasan Biaya</h3>

                    <div class="space-y-4 text-sm mb-6 border-b border-slate-100 pb-6">
                        <div class="grid grid-cols-3 gap-2">
                            <span class="text-slate-500 font-semibold">Acara</span>
                            <span class="col-span-2 text-slate-900 font-bold text-right">{{ $reservasi->paket }}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <span class="text-slate-500 font-semibold">Tanggal</span>
                            <span class="col-span-2 text-slate-900 font-bold text-right">{{ $reservasi->tanggal }}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <span class="text-slate-500 font-semibold">Sesi</span>
                            <span class="col-span-2 text-slate-900 font-bold text-right">{{ $reservasi->sesi }}</span>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6 border-b border-slate-100 pb-6 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600">Biaya Paket Dasar</span>
                            <span class="font-semibold text-slate-900" x-text="formatRupiah(hargaPaketAsli)"></span>
                        </div>
                        <div class="flex justify-between items-center text-blue-600" x-show="totalFasilitas() > 0">
                            <span>Tambahan Fasilitas</span>
                            <span class="font-semibold" x-text="'+ ' + formatRupiah(totalFasilitas())"></span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-800 font-bold text-lg">Grand Total</span>
                            <span class="text-2xl font-extrabold text-slate-900" x-text="formatRupiah(grandTotal())"></span>
                        </div>

                        <div class="bg-green-50 p-4 rounded-xl border border-green-200 mt-4">
                            <span class="text-green-800 font-semibold block text-sm mb-1">Dibayarkan Sekarang (DP):</span>
                            <div class="text-3xl font-black text-green-700">Rp {{ number_format($dp, 0, ',', '.') }}</div>
                            <p class="text-xs text-green-600 mt-1">*Sisa pembayaran dilunasi maksimal H-14</p>
                        </div>
                    </div>

                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-50 rounded-full blur-2xl -z-10"></div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function pembayaranForm() {
            return {
                hargaPaketAsli: {{ $harga }},
                loading: false,
                errorMsg: '',
                daftarFasilitas: [
                    { nama: 'Kursi Banquet',           harga: 5000,    satuan: '/pcs', qty: 0 },
                    { nama: 'Cover Kursi Banquet',      harga: 7500,    satuan: '/pcs', qty: 0 },
                    { nama: 'Shofa',                    harga: 100000,  satuan: '/pcs', qty: 0 },
                    { nama: 'Shofa Lantai',             harga: 100000,  satuan: '/pcs', qty: 0 },
                    { nama: 'Meja Tamu VIP',            harga: 50000,   satuan: '/pcs', qty: 0 },
                    { nama: 'Karpet Panggung Full',     harga: 300000,  satuan: '',     qty: 0 },
                    { nama: 'Karpet Lantai Suci',       harga: 300000,  satuan: '/roll',qty: 0 },
                    { nama: 'Perlengkapan Manasik',     harga: 500000,  satuan: '/set', qty: 0 },
                    { nama: 'Meja Terima Tamu',         harga: 35000,   satuan: '/pcs', qty: 0 },
                    { nama: 'Kursi Lipat',              harga: 2500,    satuan: '/pcs', qty: 0 },
                    { nama: 'Cover Kursi Lipat',        harga: 3500,    satuan: '/pcs', qty: 0 },
                    { nama: 'Islamic Center',           harga: 2500000, satuan: '',     qty: 0 },
                    { nama: 'Ruang VIP',                harga: 1000000, satuan: '',     qty: 0 },
                ],

                totalFasilitas() {
                    return this.daftarFasilitas.reduce((sum, item) => sum + (item.harga * item.qty), 0);
                },
                grandTotal() {
                    return this.hargaPaketAsli + this.totalFasilitas();
                },
                formatRupiah(angka) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency', currency: 'IDR', minimumFractionDigits: 0
                    }).format(angka);
                },

                // ─── FUNGSI UTAMA: ambil snap_token → tampilkan popup Midtrans ───
                async bayarMidtrans() {
                    this.loading  = true;
                    this.errorMsg = '';

                    try {
                        const res = await fetch('{{ route("reservasi.snap-token", $reservasi->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: JSON.stringify({ total_fasilitas: this.totalFasilitas() }),
                        });

                        const data = await res.json();

                        if (data.error) {
                            this.errorMsg = 'Gagal memproses pembayaran: ' + data.error;
                            this.loading  = false;
                            return;
                        }

                        // Tampilkan popup Midtrans Snap
                        window.snap.pay(data.snap_token, {
                            onSuccess: (result) => {
                                console.log('Pembayaran berhasil', result);
                                window.location.href = '{{ route("reservasi.selesai", $reservasi->id) }}';
                            },
                            onPending: (result) => {
                                console.log('Pembayaran pending', result);
                                alert('Pembayaran Anda sedang diproses. Silakan selesaikan pembayaran.');
                                this.loading = false;
                            },
                            onError: (result) => {
                                console.error('Pembayaran gagal', result);
                                this.errorMsg = 'Pembayaran gagal. Silakan coba lagi.';
                                this.loading  = false;
                            },
                            onClose: () => {
                                // User menutup popup tanpa bayar
                                this.loading = false;
                            },
                        });

                    } catch (err) {
                        this.errorMsg = 'Terjadi kesalahan. Silakan coba lagi.';
                        this.loading  = false;
                    }
                },
            }
        }

        // ─── POLLING status DP (sudah ada di blade lama, dipertahankan) ───
        const reservasiId = {{ $reservasi->id }};

        const polling = setInterval(async () => {
            try {
                const res  = await fetch(`/reservasi/check-status/${reservasiId}`);
                const data = await res.json();
                if (data.status_dp === 'lunas') {
                    clearInterval(polling);
                    window.location.href = `/reservasi/selesai/${reservasiId}`;
                }
            } catch (e) { /* silent */ }
        }, 3000);

        setTimeout(() => clearInterval(polling), 15 * 60 * 1000);

        // ─── FUNGSI UNTUK TUTUP HALAMAN SETELAH KLIK WA ───
        function tutupOtomatis() {
            // Beri jeda 1.5 detik agar tab WhatsApp sempat terbuka dengan aman
            // Lalu arahkan halaman ini ke route 'selesai'
            setTimeout(() => {
                window.location.href = '{{ route("reservasi.selesai", $reservasi->id) }}';
            }, 1500);
        }
    </script>
</body>
</html>