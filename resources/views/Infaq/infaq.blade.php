{{-- OVERLAY --}}
<div x-show="isZisModalOpen"
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-slate-900/60 z-40 backdrop-blur-sm"
     @click="closeModal()">
</div>

{{-- KONTAINER MODAL --}}
<div x-show="isZisModalOpen"
     x-cloak
     x-transition:enter="transition ease-out duration-500 transform"
     x-transition:enter-start="translate-y-full"
     x-transition:enter-end="translate-y-0"
     x-transition:leave="transition ease-in duration-300 transform"
     x-transition:leave-start="translate-y-0"
     x-transition:leave-end="translate-y-full"
     class="fixed top-20 inset-x-0 bottom-0 z-50 bg-slate-50 rounded-t-[2.5rem] shadow-2xl flex flex-col overflow-hidden">

    {{-- HEADER MODAL --}}
    <div class="bg-white px-6 py-4 border-b border-slate-200 flex justify-between items-center rounded-t-[2.5rem] z-50 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-hand-holding-dollar"></i>
            </div>
            <h2 class="text-xl font-extrabold text-slate-800">Formulir Zakat & Infaq</h2>
        </div>
        <button @click="closeModal()" class="w-10 h-10 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center hover:bg-red-100 hover:text-red-600 transition">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
    </div>

    {{-- AREA SCROLL --}}
    <div class="overflow-y-auto flex-1 pb-10">

        <div class="w-full bg-green-700 py-10 relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-10"></div>
            <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10 text-center">
                <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Tunaikan ZIS</h1>
                <p class="text-green-100 text-base max-w-2xl mx-auto italic">Penyaluran Zakat, Infaq, dan Sedekah Masjid Agung Gresik</p>
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                {{-- KOLOM KIRI: FORM --}}
                <div class="lg:col-span-7 bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
                    <div class="flex items-center gap-3 mb-8 border-b border-slate-100 pb-4">
                        <h2 class="text-2xl font-bold text-slate-800">Lengkapi Data Anda</h2>
                    </div>

                    <form action="{{ route('zis.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_pemberi" id="nama_pemberi" required
                                   placeholder="Masukkan nama Anda"
                                   class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition">
                            <div class="mt-2 flex items-center gap-2">
                                <input type="checkbox" id="hamba_allah" name="is_hamba_allah"
                                       class="w-4 h-4 text-green-600 rounded focus:ring-green-500 border-slate-300"
                                       onchange="toggleHamba()">
                                <label for="hamba_allah" class="text-sm text-slate-500 cursor-pointer">
                                    Tampilkan sebagai Hamba Allah
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-3">
                                Jenis Dana / Penyaluran <span class="text-red-500">*</span>
                            </label>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4" id="kategori-infaq-group">
                                <label class="kategori-card cursor-pointer" for="cat-fakir">
                                    <input type="radio" name="jenis_dana" id="cat-fakir"
                                           value="Infaq Fakir Miskin" required class="sr-only"
                                           onchange="pilihKategori(this)">
                                    <div class="kategori-box flex flex-col items-center text-center gap-2 p-4 rounded-2xl border-2 border-slate-200 bg-slate-50 hover:border-green-400 hover:bg-green-50 transition-all duration-200">
                                        <div class="w-12 h-12 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center text-xl">
                                            <i class="fa-solid fa-hand-holding-heart"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm leading-tight">Infaq</p>
                                            <p class="font-bold text-slate-800 text-sm leading-tight">Fakir Miskin</p>
                                        </div>
                                        <p class="text-xs text-slate-400 leading-snug">Membantu mereka yang membutuhkan</p>
                                    </div>
                                </label>

                                <label class="kategori-card cursor-pointer" for="cat-masjid">
                                    <input type="radio" name="jenis_dana" id="cat-masjid"
                                           value="Infaq Masjid" class="sr-only"
                                           onchange="pilihKategori(this)">
                                    <div class="kategori-box flex flex-col items-center text-center gap-2 p-4 rounded-2xl border-2 border-slate-200 bg-slate-50 hover:border-green-400 hover:bg-green-50 transition-all duration-200">
                                        <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xl">
                                            <i class="fa-solid fa-mosque"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm leading-tight">Infaq</p>
                                            <p class="font-bold text-slate-800 text-sm leading-tight">Masjid</p>
                                        </div>
                                        <p class="text-xs text-slate-400 leading-snug">Kemakmuran & operasional masjid</p>
                                    </div>
                                </label>

                                <label class="kategori-card cursor-pointer" for="cat-yatim">
                                    <input type="radio" name="jenis_dana" id="cat-yatim"
                                           value="Infaq Anak Yatim Piatu" class="sr-only"
                                           onchange="pilihKategori(this)">
                                    <div class="kategori-box flex flex-col items-center text-center gap-2 p-4 rounded-2xl border-2 border-slate-200 bg-slate-50 hover:border-green-400 hover:bg-green-50 transition-all duration-200">
                                        <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center text-xl">
                                            <i class="fa-solid fa-children"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm leading-tight">Infaq Anak</p>
                                            <p class="font-bold text-slate-800 text-sm leading-tight">Yatim Piatu</p>
                                        </div>
                                        <p class="text-xs text-slate-400 leading-snug">Santunan & beasiswa anak yatim</p>
                                    </div>
                                </label>
                            </div>

                            <p id="kategori-error" class="text-xs text-red-500 mt-1 hidden">Silakan pilih jenis penyaluran terlebih dahulu.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Nominal (Rp) <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                                <button type="button" onclick="setNominalZis(50000)" id="btn-50"
                                        class="py-2 px-3 border border-slate-200 rounded-lg text-sm text-slate-600 hover:border-green-300 transition">
                                    50 Ribu
                                </button>
                                <button type="button" onclick="setNominalZis(100000)" id="btn-100"
                                        class="py-2 px-3 border border-slate-200 rounded-lg text-sm text-slate-600 hover:border-green-300 transition">
                                    100 Ribu
                                </button>
                                <button type="button" onclick="setNominalZis(250000)" id="btn-250"
                                        class="py-2 px-3 border border-slate-200 rounded-lg text-sm text-slate-600 hover:border-green-300 transition">
                                    250 Ribu
                                </button>
                                <button type="button" onclick="setNominalZis(500000)" id="btn-500"
                                        class="py-2 px-3 border border-slate-200 rounded-lg text-sm text-slate-600 hover:border-green-300 transition">
                                    500 Ribu
                                </button>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <span class="text-slate-500 font-bold">Rp</span>
                                </div>
                                <input type="number" name="jumlah_dana" id="nominal" required min="10000" placeholder="0"
                                    oninput="clearBtnZis()"
                                    class="w-full pl-12 p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition text-lg font-bold text-slate-800">
                            </div>
                            <p class="text-xs text-slate-400 mt-2">*Minimum infaq Rp 10.000,-</p>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Keterangan
                                <span class="text-slate-400 font-normal">(opsional)</span>
                            </label>
                            <textarea name="keterangan" rows="3"
                                      placeholder="Contoh: Infaq atas nama keluarga, atau niat khusus..."
                                      class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition resize-none"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Bukti Transfer <span class="text-red-500">*</span>
                            </label>
                            <div id="dropzone"
                                 onclick="document.getElementById('bukti_transfer').click()"
                                 class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center cursor-pointer bg-slate-50 hover:border-green-400 hover:bg-green-50 transition">
                                <i class="fa-solid fa-upload text-2xl text-slate-400 mb-2"></i>
                                <p class="text-sm text-slate-500 mt-1">Klik untuk unggah bukti transfer</p>
                                <p class="text-xs text-slate-400 mt-1">JPG, PNG, atau PDF — maks. 2MB</p>
                            </div>
                            <input type="file" name="bukti_transfer" id="bukti_transfer"
                                   accept="image/*,.pdf" required class="hidden"
                                   onchange="previewFile(event)">

                            <div id="preview-area" class="hidden mt-3 flex items-center gap-3 border border-slate-200 rounded-xl p-3 bg-white">
                                <img id="preview-img" src="" alt="preview" class="w-12 h-12 object-cover rounded-lg hidden">
                                <i id="preview-icon" class="fa-solid fa-file-pdf text-3xl text-red-400 hidden"></i>
                                <div class="flex-1 min-w-0">
                                    <p id="preview-name" class="text-sm font-semibold text-slate-700 truncate"></p>
                                    <p id="preview-size" class="text-xs text-slate-400 mt-0.5"></p>
                                </div>
                                <button type="button" onclick="hapusFile()"
                                        class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:bg-red-100 hover:text-red-500 flex items-center justify-center transition">
                                    <i class="fa-solid fa-xmark text-sm"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" onclick="return validasiForm(event)"
                                class="w-full bg-green-600 text-white font-bold text-lg py-4 rounded-xl hover:bg-green-700 transition shadow-lg shadow-green-200 flex items-center justify-center gap-2">
                            Kirim Pembayaran <i class="fa-solid fa-paper-plane"></i>
                        </button>

                    </form>
                </div>

                {{-- KOLOM KANAN: PEMBAYARAN --}}
                <div class="lg:col-span-5 space-y-6">

                    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 text-center">
                        <div class="inline-block bg-blue-50 text-blue-700 px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                            <i class="fa-solid fa-qrcode mr-1"></i> Scan QRIS
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Masjid Agung Gresik</h3>
                        <p class="text-sm text-slate-500 mb-6">Buka aplikasi m-Banking atau e-Wallet Anda (Gopay, OVO, Dana, LinkAja, dll) lalu scan kode di bawah ini.</p>
                        <div class="bg-slate-50 p-4 rounded-2xl border-2 border-dashed border-slate-200 inline-block mb-6">
                            <img src="{{ asset('images/qris.jpeg') }}" alt="QRIS Masjid Agung Gresik"
                                 class="w-64 h-64 object-contain mx-auto rounded-xl shadow-sm">
                        </div>
                        <div class="bg-yellow-50 text-yellow-700 text-xs p-3 rounded-lg flex items-start gap-2 text-left mt-4">
                            <i class="fa-solid fa-circle-info mt-0.5"></i>
                            <p>Setelah transfer, unggah bukti dan tekan tombol <strong>Kirim Pembayaran</strong> agar niat Anda tercatat dengan baik oleh sistem kami.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">
                        <h3 class="text-base font-bold text-green-800 mb-5 flex items-center gap-2 border-b border-slate-100 pb-3">
                            <i class="fa-solid fa-circle-info text-green-500"></i> Cara Berinfaq via QRIS
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200 text-sm">1</div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">Buka Aplikasi</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Buka aplikasi Mobile Banking atau E-Wallet (GoPay, OVO, DANA, ShopeePay).</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200 text-sm">2</div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">Pilih Menu Scan</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Pilih menu Scan QR. Arahkan kamera ke gambar QRIS di atas, atau pilih dari galeri.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200 text-sm">3</div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">Masukkan Nominal</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Masukkan nominal infaq. Pastikan nama penerima <strong class="text-slate-700">Masjid Agung Gresik</strong>.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold flex-shrink-0 border border-green-200 text-sm">4</div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">Selesaikan Pembayaran</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Masukkan PIN aplikasi Anda. Jangan lupa simpan bukti transfer untuk diunggah.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    const btnIdsZis = { 50000: 'btn-50', 100000: 'btn-100', 250000: 'btn-250', 500000: 'btn-500' };
    let activeBtnZis = null;

    function setNominalZis(val) {
        Object.values(btnIdsZis).forEach(id => {
            document.getElementById(id).classList.remove('bg-green-100', 'border-green-500', 'text-green-700', 'font-bold');
            document.getElementById(id).classList.add('border-slate-200', 'text-slate-600');
        });
        document.getElementById('nominal').value = val;
        activeBtnZis = btnIdsZis[val];
        const btn = document.getElementById(activeBtnZis);
        btn.classList.add('bg-green-100', 'border-green-500', 'text-green-700', 'font-bold');
        btn.classList.remove('border-slate-200', 'text-slate-600');
    }

    function clearBtnZis() {
        if (activeBtnZis) {
            document.getElementById(activeBtnZis).classList.remove('bg-green-100', 'border-green-500', 'text-green-700', 'font-bold');
            document.getElementById(activeBtnZis).classList.add('border-slate-200', 'text-slate-600');
            activeBtnZis = null;
        }
    }

    function toggleHamba() {
        const cb = document.getElementById('hamba_allah');
        const input = document.getElementById('nama_pemberi');
        if (cb.checked) {
            input.value = 'Hamba Allah';
            input.disabled = true;
            input.classList.add('opacity-50');
        } else {
            input.value = '';
            input.disabled = false;
            input.classList.remove('opacity-50');
        }
    }

    function pilihKategori(radio) {
        document.querySelectorAll('.kategori-box').forEach(box => {
            box.classList.remove('border-green-500', 'bg-green-50', 'shadow-md');
            box.classList.add('border-slate-200', 'bg-slate-50');
        });
        const box = radio.closest('.kategori-card').querySelector('.kategori-box');
        box.classList.add('border-green-500', 'bg-green-50', 'shadow-md');
        box.classList.remove('border-slate-200', 'bg-slate-50');
        document.getElementById('kategori-error').classList.add('hidden');
    }

    function validasiForm(e) {
        const selected = document.querySelector('input[name="jenis_dana"]:checked');
        if (!selected) {
            e.preventDefault();
            document.getElementById('kategori-error').classList.remove('hidden');
            document.getElementById('kategori-infaq-group').scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }
        return true;
    }

    function previewFile(e) {
        const file = e.target.files[0];
        if (!file) return;
        document.getElementById('preview-area').classList.remove('hidden');
        document.getElementById('preview-area').classList.add('flex');
        document.getElementById('preview-name').textContent = file.name;
        document.getElementById('preview-size').textContent = (file.size / 1024).toFixed(0) + ' KB';
        const img = document.getElementById('preview-img');
        const icon = document.getElementById('preview-icon');
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = ev => {
                img.src = ev.target.result;
                img.classList.remove('hidden');
                icon.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            img.classList.add('hidden');
            icon.classList.remove('hidden');
        }
        document.getElementById('dropzone').classList.add('border-green-400', 'bg-green-50');
    }

    function hapusFile() {
        document.getElementById('bukti_transfer').value = '';
        document.getElementById('preview-area').classList.add('hidden');
        document.getElementById('preview-area').classList.remove('flex');
        document.getElementById('preview-img').src = '';
        document.getElementById('dropzone').classList.remove('border-green-400', 'bg-green-50');
    }

    function salinRekening() {
        navigator.clipboard.writeText('7788991122').then(() => {
            alert('Nomor rekening berhasil disalin!');
        });
    }
</script>