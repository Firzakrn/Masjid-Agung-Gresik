<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pelunasan Reservasi - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

        <!-- PROGRESS BAR -->
        <div class="flex items-center justify-center gap-2 md:gap-6 mb-12 overflow-x-auto pb-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center"><i class="fa-solid fa-check text-sm"></i></div>
                <div class="hidden md:block"><p class="text-sm font-bold text-slate-800">DP Disetujui</p></div>
            </div>
            <div class="w-6 md:w-12 h-0.5 bg-green-600"></div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center"><i class="fa-solid fa-check text-sm"></i></div>
                <div class="hidden md:block"><p class="text-sm font-bold text-slate-800">Verifikasi Admin</p></div>
            </div>
            <div class="w-6 md:w-12 h-0.5 bg-green-600"></div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-green-100 text-green-700 border border-green-300 font-bold flex items-center justify-center text-lg shadow-sm">3</div>
                <div class="hidden md:block"><p class="text-sm font-bold text-slate-800">Pelunasan</p></div>
            </div>
            <div class="w-6 md:w-12 h-0.5 bg-slate-200"></div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-400 font-bold flex items-center justify-center text-lg">4</div>
                <div class="hidden md:block"><p class="text-sm font-bold text-slate-400">Selesai</p></div>
            </div>
        </div>

        <!-- PEMBAYARAN -->
        <div x-data="pelunasanForm()" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <div class="lg:col-span-8 space-y-8">

                <div class="bg-green-50 border border-green-200 rounded-[2rem] p-6 md:p-8 flex gap-5 items-start">
                    <div class="w-12 h-12 rounded-full bg-green-600 text-white flex items-center justify-center text-xl flex-shrink-0 shadow-md">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-green-800 mb-1">DP Anda Telah Disetujui</h2>
                        <p class="text-sm text-green-700">Selesaikan pelunasan untuk mengkonfirmasi reservasi Anda. Sisa tagihan wajib dilunasi maksimal <span class="font-bold">H-14 sebelum acara</span>.</p>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 p-8 md:p-10">

                    <!-- OPSI 1: MIDTRANS OTOMATIS -->
                    <h2 class="text-xl font-bold text-slate-800 mb-2">Opsi 1: Pelunasan Otomatis</h2>
                    <p class="text-sm text-slate-500 mb-6">Diproses seketika via Midtrans (Transfer Bank, E-Wallet, Kartu Kredit).</p>

                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="px-3 py-1 bg-slate-100 rounded-lg text-xs font-semibold text-slate-600">Virtual Account</span>
                        <span class="px-3 py-1 bg-green-100 rounded-lg text-xs font-semibold text-green-700">GoPay</span>
                        <span class="px-3 py-1 bg-purple-100 rounded-lg text-xs font-semibold text-purple-700">OVO</span>
                        <span class="px-3 py-1 bg-blue-100 rounded-lg text-xs font-semibold text-blue-700">ShopeePay</span>
                    </div>

                    <div x-show="errorMsg" x-cloak class="mb-4 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm" x-text="errorMsg"></div>

                    <div class="flex justify-between items-center mb-8">
                        <a href="{{ route('riwayat.index') }}" class="flex items-center gap-2 text-slate-400 font-bold hover:text-slate-600 transition">
                            <i class="fa-solid fa-chevron-left text-xl"></i> Kembali
                        </a>

                        <button
                            type="button"
                            @click="bayarMidtrans()"
                            :disabled="loading"
                            class="bg-green-600 text-white font-bold py-3 px-6 rounded-2xl hover:bg-green-700 transition shadow-lg shadow-green-200 flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed"
                        >
                            <span x-show="!loading">Lunasi Sekarang <i class="fa-solid fa-bolt ml-1"></i></span>
                            <span x-show="loading" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                                Memproses...
                            </span>
                        </button>
                    </div>

                    <!-- OPSI 2: QRIS / TRANSFER MANUAL -->
                    <div class="pt-8 border-t border-slate-200">
                        <h2 class="text-xl font-bold text-slate-800 mb-2">Opsi 2: Transfer Manual / QRIS Masjid</h2>
                        <p class="text-sm text-slate-500 mb-6">Jika opsi otomatis bermasalah, silakan transfer ke rekening masjid atau scan QRIS di bawah ini.</p>

                        <div class="flex flex-col md:flex-row gap-6 items-center bg-slate-50 p-6 rounded-2xl border border-slate-200">
                            <div class="flex flex-col items-center gap-3">
                                <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-200">
                                    <img src="{{ asset('images/qris.jpeg') }}" alt="QRIS Masjid Agung Gresik" class="w-40 h-40 object-cover rounded-lg">
                                </div>
                                <a href="{{ asset('images/qris.jpeg') }}" download="QRIS_Masjid_Agung_Gresik.png" class="text-xs font-bold text-blue-600 hover:text-blue-800 bg-blue-100 hover:bg-blue-200 px-4 py-2 rounded-full transition flex items-center gap-1">
                                    <i class="fa-solid fa-download"></i> Download QRIS
                                </a>
                            </div>

                            <div class="flex-1 w-full">
                                <p class="text-sm text-slate-700 font-bold mb-2">Instruksi Pelunasan Manual:</p>
                                <ul class="list-decimal list-inside text-sm text-slate-600 space-y-1 mb-4">
                                    <li>Buka aplikasi m-Banking / E-Wallet Anda.</li>
                                    <li>Scan QRIS di samping atau hasil download.</li>
                                    <li>Masukkan nominal tepat: <span class="font-bold text-green-700">Rp {{ number_format($sisaBayar, 0, ',', '.') }}</span></li>
                                    <li>Kirim bukti transfer ke WhatsApp Admin.</li>
                                </ul>
                                @php
                                    $noWaAdmin = "6281216978686";

                                    $pesanWa =
                                        "Assalamualaikum Admin,\n".
                                        "Saya ingin konfirmasi PELUNASAN Reservasi.\n\n".
                                        "*Nama:* {$reservasi->nama_pemohon}\n".
                                        "*Paket:* {$reservasi->paket}\n".
                                        "*Tanggal Acara:* {$reservasi->tanggal}\n".
                                        "*Nominal Pelunasan:* Rp ".number_format($sisaBayar,0,',','.')."\n\n".
                                        "Berikut saya lampirkan bukti transfernya.";

                                    $linkWa = "https://wa.me/".$noWaAdmin."?text=".urlencode($pesanWa);
                                @endphp
                               <button
                                    type="button"
                                    onclick="konfirmasiWa()"
                                    class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-[#25D366] hover:bg-[#1ebd5a] text-white font-bold py-2.5 px-5 rounded-xl transition">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    Konfirmasi via WhatsApp
                                </button>

                                <div class="bg-blue-50 text-blue-700 text-xs p-3 rounded-lg border border-blue-100 flex gap-2 items-start mt-2">
                                    <i class="fa-solid fa-circle-info mt-0.5"></i>
                                    <p>Setelah Admin mengecek bukti transfer dan menekan tombol ACC Lunas, status reservasi Anda akan diperbarui otomatis.</p>
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

            <!-- STRUK -->
            <div class="lg:col-span-4">
                <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-slate-100 sticky top-10 relative overflow-hidden">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Ringkasan Pelunasan</h3>

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
                            <span class="text-slate-500">Grand Total</span>
                            <span class="font-semibold text-slate-900">Rp {{ number_format($reservasi->grand_total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-green-600">
                            <span>DP Sudah Dibayar</span>
                            <span class="font-semibold">- Rp {{ number_format($reservasi->nominal_dp, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="bg-green-50 p-4 rounded-xl border border-green-200">
                        <span class="text-green-800 font-semibold block text-sm mb-1">Sisa Pelunasan:</span>
                        <div class="text-3xl font-black text-green-700">Rp {{ number_format($sisaBayar, 0, ',', '.') }}</div>
                        <p class="text-xs text-green-600 mt-1">*Wajib dilunasi maksimal H-14 sebelum acara</p>
                    </div>

                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-green-50 rounded-full blur-2xl -z-10"></div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function pelunasanForm() {
            return {
                loading: false,
                errorMsg: '',

                async bayarMidtrans() {
                    this.loading  = true;
                    this.errorMsg = '';

                    try {
                        const res = await fetch('{{ route("reservasi.snap-token-lunas", $reservasi->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                        });

                        const data = await res.json();

                        if (data.error) {
                            this.errorMsg = 'Gagal memproses pembayaran: ' + data.error;
                            this.loading  = false;
                            return;
                        }

                        window.snap.pay(data.snap_token, {
                            onSuccess: (result) => {
                                window.location.href = '{{ route("reservasi.selesai", $reservasi->id) }}';
                            },
                            onPending: (result) => {
                                alert('Pembayaran Anda sedang diproses. Silakan selesaikan pembayaran.');
                                this.loading = false;
                            },
                            onError: (result) => {
                                this.errorMsg = 'Pembayaran gagal. Silakan coba lagi.';
                                this.loading  = false;
                            },
                            onClose: () => {
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

        async function konfirmasiWa() {

            window.open(
                'https://wa.me/6281216978686?text={{ urlencode($pesanWa) }}',
                '_blank'
            );

            try {
                await fetch('{{ route("reservasi.konfirmasi-wa",$reservasi->id) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                });

                window.location.href = '/';

            } catch (e) {
                alert('Gagal mengirim konfirmasi');
            }
        }
    </script>
</body>
</html>