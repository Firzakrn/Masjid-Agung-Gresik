<div class="w-full max-w-3xl mx-auto">
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
            
            <!-- KOLOM PILIH RESERVASI -->
            <div class="mb-6 hidden transition-all duration-300" id="div_pilih_reservasi">
                <label class="block text-sm font-bold text-slate-700 mb-2 text-blue-600"><i class="fa-solid fa-link mr-1"></i> Hubungkan ke Data Reservasi <span class="text-red-500">*</span></label>
                
                <select name="reservasi_id" id="input_reservasi_id" class="w-full border border-slate-300 px-4 py-3 rounded-xl text-sm bg-white outline-none focus:ring-2 focus:ring-green-500">
                    <option value="" disabled selected data-sisa="0">Pilih data reservasi...</option>
                    @foreach($semuaReservasi as $rsv)
                        @php
                            // 👇 UBAH RUMUS INI JUGA: Murni ambil dari transaksi agar nominal sisa tidak salah
                            $terbayar = $rsv->transaksis->where('jenis', 'pemasukan')->sum('nominal');
                            $sisa = max(0, $rsv->grand_total - $terbayar);
                        @endphp
                        <option value="{{ $rsv->id }}" data-sisa="{{ $sisa }}">
                            #RSV-{{ $rsv->id }} | {{ $rsv->nama_pemohon }} - Paket: {{ $rsv->paket }}
                        </option>
                    @endforeach
                </select>
                                
                <!-- Teks Notifikasi Sisa Bayar -->
                <p id="teks_sisa_bayar" class="text-xs font-bold text-orange-600 mt-2 hidden"></p>
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

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const kategoriPemasukan = @json($kategoriPemasukan ?? []);
        const kategoriPengeluaran = @json($kategoriPengeluaran ?? []);

        const radioIn  = document.getElementById('radio_pemasukan');
        const radioOut = document.getElementById('radio_pengeluaran');
        const katSelect = document.getElementById('kategori_akun');
        
        const divPilihReservasi = document.getElementById('div_pilih_reservasi');
        const inputReservasiId = document.getElementById('input_reservasi_id');

        function resetReservasiField() {
            if(!divPilihReservasi) return;
            divPilihReservasi.classList.add('hidden');
            inputReservasiId.removeAttribute('required');
            inputReservasiId.value = "";
        }

        if(radioIn) {
            radioIn.addEventListener('change', () => {
                katSelect.disabled = false;
                katSelect.innerHTML = '<option value="" disabled selected>-- Pilih Kategori Pemasukan --</option>' + 
                    kategoriPemasukan.map(k => `<option value="${k.id}">${k.nama}</option>`).join('');
                resetReservasiField();
            });
        }

        if(radioOut) {
            radioOut.addEventListener('change', () => {
                katSelect.disabled = false;
                katSelect.innerHTML = '<option value="" disabled selected>-- Pilih Kategori Pengeluaran --</option>' + 
                    kategoriPengeluaran.map(k => `<option value="${k.id}">${k.nama}</option>`).join('');
                resetReservasiField();
            });
        }

        if(katSelect) {
            katSelect.addEventListener('change', function() {
                let namaKategoriTerpilih = this.options[this.selectedIndex].text.toLowerCase();
                
                if (namaKategoriTerpilih.includes('pelunasan')) {
                    divPilihReservasi.classList.remove('hidden');
                    inputReservasiId.setAttribute('required', 'required');
                } else {
                    resetReservasiField();
                }
            });
        }

        // LOGIKA AUTO-FILL NOMINAL SISA BAYAR
        const selectReservasi = document.getElementById('input_reservasi_id');
        const inputNominal = document.querySelector('input[name="nominal"]');
        const teksSisa = document.getElementById('teks_sisa_bayar');

        if(selectReservasi) {
            selectReservasi.addEventListener('change', function() {
                // Ambil data "sisa bayar" dari opsi yang dipilih admin
                let selectedOption = this.options[this.selectedIndex];
                let sisa = selectedOption.getAttribute('data-sisa');
                
                if(sisa && parseInt(sisa) > 0) {
                    // Isi otomatis input nominal
                    inputNominal.value = sisa; 
                    // Tampilkan notifikasi
                    teksSisa.textContent = "Sisa tagihan: Rp " + parseInt(sisa).toLocaleString('id-ID');
                    teksSisa.classList.remove('hidden');
                } else if (sisa !== null && parseInt(sisa) === 0) {
                    inputNominal.value = "";
                    teksSisa.textContent = " sudah lunas.";
                    teksSisa.classList.remove('hidden', 'text-orange-600');
                    teksSisa.classList.add('text-green-600');
                } else {
                    inputNominal.value = "";
                    teksSisa.classList.add('hidden');
                }
            });
        }
    });
</script>
@endpush