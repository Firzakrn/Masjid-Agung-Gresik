
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

    <!-- Kontainer Modal -->
    <div x-show="isZisModalOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-500 transform"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-300 transform"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         class="fixed top-20 inset-x-0 bottom-0 z-50 bg-slate-50 rounded-t-[2.5rem] shadow-2xl flex flex-col overflow-hidden">
        
        <!-- Header Modal & Tombol Close -->
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

        <!-- Area Scroll Form ZIS -->
        <div class="overflow-y-auto flex-1 pb-10">
            <!-- Header Biru/Hijau ZIS -->
            <div class="w-full bg-green-700 py-10 relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-10"></div>
                <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10 text-center">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Tunaikan ZIS</h1>
                    <p class="text-green-100 text-base max-w-2xl mx-auto italic">Penyaluran Zakat, Infaq, dan Sedekah Masjid Agung Gresik</p>
                </div>
            </div>

            <!-- MAIN CONTENT FORM -->
            <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- KOLOM KIRI: FORMULIR DATA -->
                    <div class="lg:col-span-7 bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
                        <div class="flex items-center gap-3 mb-8 border-b border-slate-100 pb-4">
                            <h2 class="text-2xl font-bold text-slate-800">Lengkapi Data Anda</h2>
                        </div>

                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Input Nama -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap (Muzakki/Munfiq) <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_pemberi" required placeholder="Masukkan nama Anda" 
                                       class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition">
                                <div class="mt-2 flex items-center gap-2">
                                    <input type="checkbox" id="hamba_allah" name="is_hamba_allah" class="w-4 h-4 text-green-600 rounded focus:ring-green-500 border-slate-300">
                                    <label for="hamba_allah" class="text-sm text-slate-500">Sembunyikan nama (Sebagai Hamba Allah)</label>
                                </div>
                            </div>

                            <!-- Input Jenis ZIS (Sudah ditambah Infaq/Sedekah) -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Dana / Penyaluran <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="jenis_dana" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition appearance-none font-semibold text-slate-700">
                                        <option value="" disabled selected>-- Pilih Jenis Penyaluran --</option>
                                        <optgroup label="Zakat Wajib">
                                            <option value="Zakat Fitrah">Zakat Fitrah</option>
                                            <option value="Zakat Maal">Zakat Maal (Harta)</option>
                                        </optgroup>
                                        <optgroup label="Infaq & Sedekah">
                                            <option value="Infaq Operasional Masjid">Infaq Operasional Masjid</option>
                                            <option value="Infaq Pembangunan">Infaq Pembangunan / Renovasi</option>
                                            <option value="Sedekah Anak Yatim">Sedekah Anak Yatim</option>
                                        </optgroup>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Input Nominal -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Nominal (Rp) <span class="text-red-500">*</span></label>
                                
                                <!-- Pilihan Nominal Cepat -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                                    <button type="button" @click="setNominal(50000)" :class="nominal === 50000 ? 'bg-green-100 border-green-500 text-green-700 font-bold' : 'bg-white border-slate-200 text-slate-600 hover:border-green-300'" class="py-2 px-3 border rounded-lg text-sm transition">50 Ribu</button>
                                    <button type="button" @click="setNominal(100000)" :class="nominal === 100000 ? 'bg-green-100 border-green-500 text-green-700 font-bold' : 'bg-white border-slate-200 text-slate-600 hover:border-green-300'" class="py-2 px-3 border rounded-lg text-sm transition">100 Ribu</button>
                                    <button type="button" @click="setNominal(250000)" :class="nominal === 250000 ? 'bg-green-100 border-green-500 text-green-700 font-bold' : 'bg-white border-slate-200 text-slate-600 hover:border-green-300'" class="py-2 px-3 border rounded-lg text-sm transition">250 Ribu</button>
                                    <button type="button" @click="setNominal(500000)" :class="nominal === 500000 ? 'bg-green-100 border-green-500 text-green-700 font-bold' : 'bg-white border-slate-200 text-slate-600 hover:border-green-300'" class="py-2 px-3 border rounded-lg text-sm transition">500 Ribu</button>
                                </div>

                                <!-- Input Text Nominal -->
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <span class="text-slate-500 font-bold">Rp</span>
                                    </div>
                                    <input type="number" name="jumlah_dana" x-model="nominal" required min="10000" placeholder="0" 
                                           class="w-full pl-12 p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition text-lg font-bold text-slate-800">
                                </div>
                                <p class="text-xs text-slate-400 mt-2">*Minimal donasi Rp 10.000</p>
                            </div>

                            <!-- Doa / Catatan -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Doa / Niat (Opsional)</label>
                                <textarea name="doa" rows="3" placeholder="Tuliskan doa atau niat Anda di sini..." 
                                          class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white outline-none transition resize-none"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-green-600 text-white font-bold text-lg py-4 rounded-xl hover:bg-green-700 transition shadow-lg shadow-green-200 flex items-center justify-center gap-2">
                                Konfirmasi Pembayaran <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>

                    <!-- KOLOM KANAN: QRIS & INFO PEMBAYARAN -->
                    <div class="lg:col-span-5 space-y-6">
                        <!-- KOTAK QRIS -->
                        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 text-center lg:sticky lg:top-8">
                            <div class="inline-block bg-blue-50 text-blue-700 px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                                <i class="fa-solid fa-qrcode mr-1"></i> Scan QRIS
                            </div>
                            
                            <h3 class="text-xl font-bold text-slate-800 mb-2">Masjid Agung Gresik</h3>
                            <p class="text-sm text-slate-500 mb-6">Buka aplikasi m-Banking atau e-Wallet Anda (Gopay, OVO, Dana, LinkAja, dll) lalu scan kode di bawah ini.</p>
                            
                            <div class="bg-slate-50 p-4 rounded-2xl border-2 border-dashed border-slate-200 inline-block mb-6">
                                <img src="{{ asset('images/qris.jpeg') }}" alt="QRIS Masjid Agung Gresik" class="w-64 h-64 object-contain mx-auto rounded-xl shadow-sm">
                            </div>

                            <!-- Alternatif Transfer Bank -->
                            <div class="border-t border-slate-100 pt-6 text-left">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Atau Transfer Manual:</p>
                                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 flex items-center justify-between mb-3">
                                    <div>
                                        <p class="text-xs text-slate-500 font-semibold mb-1">BSI (Bank Syariah Indonesia)</p>
                                        <p class="font-mono font-bold text-lg text-slate-800">77 88 99 11 22</p>
                                        <p class="text-xs text-slate-500">a.n. ZIS Masjid Agung Gresik</p>
                                    </div>
                                    <button class="w-10 h-10 rounded-full bg-white border border-slate-200 text-slate-500 hover:text-green-600 hover:border-green-300 flex items-center justify-center transition shadow-sm" title="Salin Rekening">
                                        <i class="fa-regular fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="bg-yellow-50 text-yellow-700 text-xs p-3 rounded-lg flex items-start gap-2 text-left mt-4">
                                <i class="fa-solid fa-circle-info mt-0.5"></i>
                                <p>Setelah transfer, pastikan Anda menekan tombol <strong>Konfirmasi Pembayaran</strong> agar niat Anda tercatat dengan baik oleh sistem kami.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
