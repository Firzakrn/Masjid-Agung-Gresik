<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran & Fasilitas - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">

    <div class="max-w-6xl mx-auto px-4 py-12">
        
        <!-- PROGRESS BAR -->
        <div class="flex items-center justify-center gap-2 md:gap-6 mb-12 overflow-x-auto pb-4">
            <!-- STEP 1, 2, 3 (Selesai - Centang Biru) -->
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

            <!-- STEP 4: PEMBAYARAN (Aktif) -->
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 border border-blue-200 font-bold flex items-center justify-center text-lg shadow-sm">4</div>
                <div class="hidden md:block"><p class="text-sm font-bold text-slate-800">Pembayaran</p></div>
            </div>
        </div>

        <!-- FORM UTAMA DENGAN ALPINE JS -->
        <div x-data="pembayaranForm()" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- KOLOM KIRI: FASILITAS & INFO PEMBAYARAN -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- BLOK FASILITAS TAMBAHAN -->
                <div x-data="{ openFasilitas: false }" class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
                    
                    <!-- Header (Sekarang jadi tombol yang bisa diklik) -->
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
                        <!-- Ikon Panah yang berputar saat diklik -->
                        <div class="w-10 h-10 rounded-full bg-blue-200 flex items-center justify-center text-blue-700 flex-shrink-0">
                            <svg :class="openFasilitas ? 'rotate-180' : ''" class="w-6 h-6 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    
                    <!-- Konten Daftar Fasilitas (Disembunyikan default, muncul saat openFasilitas = true) -->
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

                <!-- BLOK INFO REKENING -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 p-8 md:p-10">
                    <h2 class="text-xl font-bold text-slate-800 mb-6 border-b border-slate-100 pb-2">Metode Pembayaran DP</h2>
                    
                    <div class="flex flex-col md:flex-row gap-6 items-center bg-green-50 p-6 rounded-2xl border border-green-200 mb-8">
                        <div class="w-24 h-24 bg-white rounded-xl shadow-sm border border-slate-200 flex items-center justify-center p-2 flex-shrink-0">
                            <!-- Tempat QRIS Image, gunakan asetmu nanti -->
                            <i class="fa-solid fa-qrcode text-5xl text-slate-300"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-green-800 text-lg mb-1">Transfer Bank / QRIS</h3>
                            <p class="text-sm text-green-700 mb-2">Silakan transfer DP ke rekening resmi Masjid Agung Gresik:</p>
                            <p class="font-mono font-bold text-xl text-slate-900 bg-white inline-block px-4 py-2 rounded-lg border border-green-300">BSI: 1234 5678 90</p>
                            <p class="text-xs text-green-600 mt-2 font-semibold">a.n. Takmir Masjid Agung Gresik</p>
                        </div>
                    </div>

                    <form action="{{ route('reservasi.selesai', $reservasi->id) }}" method="POST">
                        @csrf
                        <!-- Hidden input untuk mengirim data fasilitas ke database nanti -->
                        <input type="hidden" name="total_fasilitas" :value="totalFasilitas()">
                        
                        <div class="flex justify-between items-center pt-6 border-t border-slate-200">
                            <a href="{{ url()->previous() }}" class="flex items-center gap-2 text-slate-400 font-bold hover:text-slate-600 transition">
                                <i class="fa-solid fa-chevron-left text-xl"></i> Kembali
                            </a>
                            <button type="submit" class="bg-green-600 text-white font-bold py-4 px-8 rounded-2xl hover:bg-green-700 transition shadow-lg shadow-green-200 flex items-center gap-2">
                                Selesaikan Reservasi <i class="fa-solid fa-check"></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <!-- KOLOM KANAN: STRUK REAL-TIME -->
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

                    <!-- Hitungan Dinamis -->
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
                            <span class="text-green-800 font-semibold block text-sm mb-1">Minimal DP (Pembayaran Awal):</span>
                            <div class="text-3xl font-black text-green-700">Rp {{ number_format($dp, 0, ',', '.') }}</div>
                            <p class="text-xs text-green-600 mt-1">*Sisa pembayaran dilunasi maksimal H-14</p>
                        </div>
                    </div>

                    <!-- Dekorasi Lingkaran -->
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-50 rounded-full blur-2xl -z-10"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- SCRIPT ALPINE -->
    <script>
        function pembayaranForm() {
            return {
                hargaPaketAsli: {{ $harga }},
                daftarFasilitas: [
                    { nama: 'Kursi Banquet', harga: 5000, satuan: '/pcs', qty: 0 },
                    { nama: 'Cover Kursi Banquet', harga: 7500, satuan: '/pcs', qty: 0 },
                    { nama: 'Shofa', harga: 100000, satuan: '/pcs', qty: 0 },
                    { nama: 'Shofa Lantai', harga: 100000, satuan: '/pcs', qty: 0 },
                    { nama: 'Meja Tamu VIP', harga: 50000, satuan: '/pcs', qty: 0 },
                    { nama: 'Karpet Panggung Full', harga: 300000, satuan: '', qty: 0 },
                    { nama: 'Karpet Lantai Suci', harga: 300000, satuan: '/roll', qty: 0 },
                    { nama: 'Perlengkapan Manasik', harga: 500000, satuan: '/set', qty: 0 },
                    { nama: 'Meja Terima Tamu', harga: 35000, satuan: '/pcs', qty: 0 },
                    { nama: 'Kursi Lipat', harga: 2500, satuan: '/pcs', qty: 0 },
                    { nama: 'Cover Kursi Lipat', harga: 3500, satuan: '/pcs', qty: 0 },
                    { nama: 'Islamic Center', harga: 2500000, satuan: '', qty: 0 },
                    { nama: 'Ruang VIP', harga: 1000000, satuan: '', qty: 0 }
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
                }
            }
        }
    </script>
</body>
</html>