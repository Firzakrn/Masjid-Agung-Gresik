<div class="w-full max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Catat Transaksi Manual Baru</h2>
        
        <form action="{{ route('admin.keuangan.tambah') }}" method="POST" enctype="multipart/form-data">
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

            {{-- ===================== SECTION PEMASUKAN ===================== --}}
            <div id="section_pemasukan" class="hidden">

                <div class="mb-6 hidden transition-all duration-300" id="div_pilih_reservasi">
                    <label class="block text-sm font-bold text-blue-600 mb-2">
                        <i class="fa-solid fa-link mr-1"></i> Hubungkan ke Data Reservasi <span class="text-red-500">*</span>
                    </label>
                    <select name="reservasi_id" id="input_reservasi_id" class="w-full border border-slate-300 px-4 py-3 rounded-xl text-sm bg-white outline-none focus:ring-2 focus:ring-green-500">
                        <option value="" disabled selected data-sisa="0">Pilih data reservasi...</option>
                        @foreach($semuaReservasi as $rsv)
                            @php
                                $terbayar = $rsv->transaksis->where('jenis', 'pemasukan')->sum('nominal');
                                $sisa = max(0, $rsv->grand_total - $terbayar);
                            @endphp
                            <option value="{{ $rsv->id }}" data-sisa="{{ $sisa }}">
                                #RSV-{{ $rsv->id }} | {{ $rsv->nama_pemohon }} - Paket: {{ $rsv->paket }}
                            </option>
                        @endforeach
                    </select>
                    <p id="teks_sisa_bayar" class="text-xs font-bold text-orange-600 mt-2 hidden"></p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Penyetor</label>
                    <input type="text" name="nama_penyetor" placeholder="Contoh: Abdullah Ilham" class="w-full bg-slate-50 border border-slate-300 px-4 py-3 rounded-xl text-sm outline-none focus:ring-2 focus:ring-green-500" />
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-3">Bentuk Transaksi <span class="text-red-500">*</span></label>
                    <div class="flex gap-4 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                        <label class="flex items-center gap-2 font-bold cursor-pointer text-slate-700 hover:text-green-600">
                            <input type="radio" name="uang" value="Tunai" class="accent-green-600 w-5 h-5"> Uang Tunai
                        </label>
                        <label class="flex items-center gap-2 font-bold cursor-pointer text-slate-700 hover:text-red-600">
                            <input type="radio" name="uang" value="Non Tunai" class="accent-red-600 w-5 h-5"> Non Tunai (Transfer, E-Wallet, dll)
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Keterangan</label>
                    <input type="text" name="keterangan_pemasukan" placeholder="Contoh: Kotak amal Jumat minggu ke-1" class="w-full bg-slate-50 border border-slate-300 px-4 py-3 rounded-xl text-sm outline-none focus:ring-2 focus:ring-green-500" />
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nominal (Rp) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-500 font-bold font-mono">Rp</span>
                        </div>
                        <input type="number" name="nominal" id="nominal_pemasukan" class="w-full bg-slate-50 border border-slate-300 pl-12 pr-4 py-3 rounded-xl font-bold text-lg outline-none focus:ring-2 focus:ring-green-500" placeholder="0" />
                    </div>
                </div>

            </div>

            {{-- ===================== SECTION PENGELUARAN ===================== --}}
            <div id="section_pengeluaran" class="hidden">

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Pihak Penerima <span class="text-red-500">*</span></label>
                    <input type="text" name="pihak_penerima" id="pihak_penerima" placeholder="Contoh: Toko Bangunan Maju, CV. Sejahtera, dll" class="w-full bg-slate-50 border border-slate-300 px-4 py-3 rounded-xl text-sm outline-none focus:ring-2 focus:ring-red-400" />
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-3">Bentuk Transaksi <span class="text-red-500">*</span></label>
                    <div class="flex gap-4 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                        <label class="flex items-center gap-2 font-bold cursor-pointer text-slate-700 hover:text-green-600">
                            <input type="radio" name="bentuk_pengeluaran" id="bentuk_tunai" value="Tunai" class="accent-green-600 w-5 h-5"> Uang Tunai
                        </label>
                        <label class="flex items-center gap-2 font-bold cursor-pointer text-slate-700 hover:text-red-600">
                            <input type="radio" name="bentuk_pengeluaran" id="bentuk_nontunai" value="Non Tunai" class="accent-red-600 w-5 h-5"> Non Tunai (Transfer, E-Wallet, dll)
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Keterangan</label>
                    <input type="text" name="keterangan_pengeluaran" id="keterangan_pengeluaran" placeholder="Contoh: Pembelian cat tembok untuk renovasi lantai 2" class="w-full bg-slate-50 border border-slate-300 px-4 py-3 rounded-xl text-sm outline-none focus:ring-2 focus:ring-red-400" />
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nominal (Rp) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-500 font-bold font-mono">Rp</span>
                        </div>
                        <input type="number" name="nominal" id="nominal_pengeluaran" class="w-full bg-slate-50 border border-slate-300 pl-12 pr-4 py-3 rounded-xl font-bold text-lg outline-none focus:ring-2 focus:ring-red-400" placeholder="0" />
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Bukti Transaksi</label>
                    <div class="relative">
                        <input type="file" name="bukti_bayar" id="bukti_bayar" accept="image/*,.pdf"
                            class="w-full bg-slate-50 border border-slate-300 px-4 py-3 rounded-xl text-sm outline-none focus:ring-2 focus:ring-red-400 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-red-50 file:text-red-600 hover:file:bg-red-100 cursor-pointer" />
                    </div>
                    <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, PDF. Maks. 2MB.</p>
                </div>

            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-10 py-4 rounded-xl font-bold shadow-md shadow-green-200 transition">
                    Simpan Transaksi Manual
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const kategoriPemasukan   = @json($kategoriPemasukan ?? []);
        const kategoriPengeluaran = @json($kategoriPengeluaran ?? []);

        const radioIn   = document.getElementById('radio_pemasukan');
        const radioOut  = document.getElementById('radio_pengeluaran');
        const katSelect = document.getElementById('kategori_akun');

        const sectionPemasukan   = document.getElementById('section_pemasukan');
        const sectionPengeluaran = document.getElementById('section_pengeluaran');

        const divPilihReservasi = document.getElementById('div_pilih_reservasi');
        const inputReservasiId  = document.getElementById('input_reservasi_id');

        function resetReservasiField() {
            if (!divPilihReservasi) return;
            divPilihReservasi.classList.add('hidden');
            inputReservasiId.removeAttribute('required');
            inputReservasiId.value = "";
        }

        function showSection(jenis) {
            if (jenis === 'pemasukan') {
                sectionPemasukan.classList.remove('hidden');
                sectionPengeluaran.classList.add('hidden');

                document.getElementById('nominal_pemasukan').setAttribute('required', 'required');
                document.getElementById('nominal_pemasukan').removeAttribute('disabled');

                document.getElementById('nominal_pengeluaran').removeAttribute('required');
                document.getElementById('nominal_pengeluaran').setAttribute('disabled', 'disabled');

            } else {
                sectionPengeluaran.classList.remove('hidden');
                sectionPemasukan.classList.add('hidden');

                document.getElementById('nominal_pengeluaran').setAttribute('required', 'required');
                document.getElementById('nominal_pengeluaran').removeAttribute('disabled');

                document.getElementById('nominal_pemasukan').removeAttribute('required');
                document.getElementById('nominal_pemasukan').setAttribute('disabled', 'disabled');

                resetReservasiField();
            }
        }

        if (radioIn) {
            radioIn.addEventListener('change', () => {
                katSelect.disabled = false;
                katSelect.innerHTML = '<option value="" disabled selected>-- Pilih Kategori Pemasukan --</option>' +
                    kategoriPemasukan.map(k => `<option value="${k.id}">${k.nama}</option>`).join('');
                showSection('pemasukan');
                resetReservasiField();
            });
        }

        if (radioOut) {
            radioOut.addEventListener('change', () => {
                katSelect.disabled = false;
                katSelect.innerHTML = '<option value="" disabled selected>-- Pilih Kategori Pengeluaran --</option>' +
                    kategoriPengeluaran.map(k => `<option value="${k.id}">${k.nama}</option>`).join('');
                showSection('pengeluaran');
            });
        }

        if (katSelect) {
            katSelect.addEventListener('change', function () {
                let namaKategori = this.options[this.selectedIndex].text.toLowerCase();
                if (radioIn.checked && namaKategori.includes('pelunasan')) {
                    divPilihReservasi.classList.remove('hidden');
                    inputReservasiId.setAttribute('required', 'required');
                } else {
                    resetReservasiField();
                }
            });
        }

        const selectReservasi = document.getElementById('input_reservasi_id');
        const teksSisa        = document.getElementById('teks_sisa_bayar');

        if (selectReservasi) {
            selectReservasi.addEventListener('change', function () {
                let selectedOption = this.options[this.selectedIndex];
                let sisa = selectedOption.getAttribute('data-sisa');
                let nominalEl = document.getElementById('nominal_pemasukan');

                if (sisa && parseInt(sisa) > 0) {
                    nominalEl.value = sisa;
                    teksSisa.textContent = "Sisa tagihan: Rp " + parseInt(sisa).toLocaleString('id-ID');
                    teksSisa.classList.remove('hidden', 'text-green-600');
                    teksSisa.classList.add('text-orange-600');
                } else if (sisa !== null && parseInt(sisa) === 0) {
                    nominalEl.value = "";
                    teksSisa.textContent = "Reservasi ini sudah lunas.";
                    teksSisa.classList.remove('hidden', 'text-orange-600');
                    teksSisa.classList.add('text-green-600');
                } else {
                    nominalEl.value = "";
                    teksSisa.classList.add('hidden');
                }
            });
        }

        document.addEventListener('submit', function (e) {
            const form = e.target;
            if (!form.action.includes('keuangan')) return; // pastikan form yang benar
            const keteranganFinal = document.getElementById('keterangan_final');

            if (radioIn && radioIn.checked) {
                const namaPenyetor    = document.querySelector('input[name="nama_penyetor"]')?.value.trim() ?? '';
                const bentukTrx       = document.querySelector('input[name="uang"]:checked')?.value ?? '';
                const keteranganInput = document.querySelector('input[name="keterangan_pemasukan"]')?.value.trim() ?? '';

                let bagian = [];
                if (namaPenyetor) bagian.push('Penyetor: ' + namaPenyetor);
                if (bentukTrx)    bagian.push('Via: ' + bentukTrx);

                keteranganFinal.value = (keteranganInput ? keteranganInput + (bagian.length ? ' | ' : '') : '') + bagian.join(' | ');

            } else if (radioOut && radioOut.checked) {
                const pihakPenerima   = document.getElementById('pihak_penerima')?.value.trim() ?? '';
                const bentukPengeluaran = document.querySelector('input[name="bentuk_pengeluaran"]:checked')?.value ?? '';
                const keteranganPengeluaran = document.getElementById('keterangan_pengeluaran')?.value.trim() ?? '';

                let bagian = [];
                if (pihakPenerima)      bagian.push('Penerima: ' + pihakPenerima);
                if (bentukPengeluaran)  bagian.push('Via: ' + bentukPengeluaran);

                keteranganFinal.value = (keteranganPengeluaran ? keteranganPengeluaran + (bagian.length ? ' | ' : '') : '') + bagian.join(' | ');
            }
        });

    });
</script>
@endpush