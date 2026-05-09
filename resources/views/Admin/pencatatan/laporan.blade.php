<div class="w-full max-w-5xl mx-auto">
    <!-- FILTER LAPORAN -->
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

    <!-- KERTAS LAPORAN -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 md:p-12 relative overflow-hidden">
        {{-- Watermark Ikon Masjid --}}
        <i class="fa-solid fa-mosque absolute text-[200px] text-slate-50 -right-10 -bottom-10 opacity-50 pointer-events-none"></i>
        
        <div class="text-center border-b-2 border-slate-800 pb-4 mb-8 relative z-10">
            <h2 class="text-2xl font-black uppercase tracking-widest text-slate-800">Laporan Arus Kas</h2>
            <h3 class="text-lg font-bold text-slate-600 mt-1">Masjid Agung Gresik</h3>
            <p id="labelPeriode" class="text-sm text-slate-500 mt-2 font-medium">Periode: -</p>
        </div>

        <div class="mb-8 relative z-10">
            <h4 class="font-bold text-lg text-green-700 border-b border-slate-200 pb-2 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-circle-plus text-sm"></i> PENDAPATAN (PEMASUKAN)
            </h4>
            <div id="listPemasukan" class="space-y-3 px-4"></div>
            <div class="flex justify-between items-center mt-4 px-4 py-3 bg-green-50 rounded-xl border border-green-100 font-bold text-green-800 shadow-sm">
                <span>TOTAL PENDAPATAN</span>
                <span id="totalPemasukan" class="text-xl tracking-wide">Rp 0</span>
            </div>
        </div>

        <div class="mb-8 relative z-10">
            <h4 class="font-bold text-lg text-red-600 border-b border-slate-200 pb-2 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-circle-minus text-sm"></i> PENGELUARAN (BEBAN)
            </h4>
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

@push('scripts')
<script>
    // ============================================================
    // LOGIKA LAPORAN ARUS KAS (AJAX FETCH)
    // ============================================================
    function muatLaporan(bulan = null, tahun = null) {
        const url = bulan && tahun
            ? `{{ route('admin.keuangan.laporan') }}?bulan=${bulan}&tahun=${tahun}`
            : `{{ route('admin.keuangan.laporan') }}`;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                document.getElementById('labelPeriode').textContent = 'Periode: ' + data.periode;

                const listIn  = document.getElementById('listPemasukan');
                const listOut = document.getElementById('listPengeluaran');

                // Render List Pemasukan
                listIn.innerHTML = data.pemasukan.length > 0
                    ? data.pemasukan.map(t => {
                        const nama = data.ringkasan ? t.nama : (t.kategori?.nama ?? '-');
                        const ket  = data.ringkasan ? '' : `<span class="text-xs text-slate-400 ml-2">${t.keterangan}</span>`;
                        return `
                            <div class="flex justify-between text-slate-700 border-b border-dashed border-slate-200 pb-1">
                                <div><span class="font-semibold">${nama}</span>${ket}</div>
                                <span class="font-bold text-green-600">+ ${formatRupiah(t.nominal)}</span>
                            </div>
                        `;
                    }).join('')
                    : '<p class="text-slate-400 text-sm italic">Tidak ada pemasukan.</p>';

                // Render List Pengeluaran
                listOut.innerHTML = data.pengeluaran.length > 0
                    ? data.pengeluaran.map(t => {
                        const nama = data.ringkasan ? t.nama : (t.kategori?.nama ?? '-');
                        const ket  = data.ringkasan ? '' : `<span class="text-xs text-slate-400 ml-2">${t.keterangan}</span>`;
                        return `
                            <div class="flex justify-between text-slate-700 border-b border-dashed border-slate-200 pb-1">
                                <div><span class="font-semibold">${nama}</span>${ket}</div>
                                <span class="font-bold text-red-600">( ${formatRupiah(t.nominal)} )</span>
                            </div>
                        `;
                    }).join('')
                    : '<p class="text-slate-400 text-sm italic">Tidak ada pengeluaran.</p>';

                // Update Total
                document.getElementById('totalPemasukan').textContent = formatRupiah(data.totalPemasukan);
                document.getElementById('totalPengeluaran').textContent = '( ' + formatRupiah(data.totalPengeluaran) + ' )';

                // Update Surplus
                const surplusEl = document.getElementById('surplus');
                surplusEl.textContent = formatRupiah(data.surplus);
                surplusEl.className = data.surplus >= 0 ? 'text-green-600 font-bold' : 'text-red-600 font-bold';
            })
            .catch(err => {
                console.error(err);
                alert("Gagal memuat laporan, pastikan route sudah benar.");
            });
    }

    // Trigger Fetch saat tombol Tampilkan Filter diklik
    document.getElementById('btnTampilkanLaporan').addEventListener('click', function () {
        const bulan = document.getElementById('filterBulan').value;
        const tahun = document.getElementById('filterTahun').value;
        muatLaporan(bulan, tahun);
    });

    // Otomatis load data AJAX saat tab menu Laporan di navigasi atas diklik
    document.getElementById('btnLaporan').addEventListener('click', function() {
        muatLaporan();
    });
</script>
@endpush