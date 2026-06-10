<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan | Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    
    @include('navbar')

    <main class="flex-grow max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-green-800 mb-3">Laporan Keuangan</h1>
            <p class="text-gray-600">Transparansi pengelolaan dana umat dan kas Masjid Agung Gresik.</p>
            <div class="w-24 h-1 bg-green-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-4 items-center mb-8 justify-center">
            <span class="text-sm font-bold text-gray-600"><i class="fa-solid fa-calendar-days text-green-600 mr-2"></i>Periode Laporan:</span>
            <select id="filterBulan" class="bg-gray-50 border border-gray-300 px-4 py-2.5 rounded-xl text-sm outline-none focus:ring-2 focus:ring-green-600 w-full md:w-48 font-medium">
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
            <select id="filterTahun" class="bg-gray-50 border border-gray-300 px-4 py-2.5 rounded-xl text-sm outline-none focus:ring-2 focus:ring-green-600 w-full md:w-32 font-medium">
                <option value="2026" selected>2026</option>
                <option value="2025">2025</option>
            </select>
            <button id="btnTampilkanLaporan" class="bg-green-700 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-green-800 transition w-full md:w-auto shadow-md">Tampilkan</button>
        </div>

        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 md:p-14">
            <div class="text-center border-b-4 border-double border-green-800 pb-8 mb-10">
                <img src="{{ asset('images/logoo.png') }}" alt="Logo Masjid" class="h-20 mx-auto mb-4 drop-shadow-sm">
                <h2 class="text-2xl font-bold uppercase tracking-wider text-gray-800">Laporan Penerimaan & Pengeluaran Kas</h2>
                <h3 class="text-xl font-bold text-green-700 mt-1">Masjid Agung Gresik</h3>
                <p id="labelPeriode" class="text-sm text-gray-500 mt-2 font-medium">Pilih periode untuk melihat data</p>
            </div>

            <div class="mb-10">
                <h4 class="font-bold text-lg text-white bg-green-700 px-5 py-3 rounded-t-xl shadow-sm mb-4"><i class="fa-solid fa-arrow-down mr-2"></i> A. PENERIMAAN (PER KATEGORI)</h4>
                <div id="listPemasukan" class="space-y-3 px-2 md:px-5"></div>
                <div class="flex justify-between items-center mt-5 px-5 py-4 bg-green-50 rounded-xl border border-green-200 font-bold text-green-900">
                    <span>TOTAL PENERIMAAN</span>
                    <span id="totalPemasukan">Rp 0</span>
                </div>
            </div>

            <div class="mb-10">
                <h4 class="font-bold text-lg text-white bg-red-600 px-5 py-3 rounded-t-xl shadow-sm mb-4"><i class="fa-solid fa-arrow-up mr-2"></i> B. PENGELUARAN (PER KATEGORI)</h4>
                <div id="listPengeluaran" class="space-y-3 px-2 md:px-5"></div>
                <div class="flex justify-between items-center mt-5 px-5 py-4 bg-red-50 rounded-xl border border-red-200 font-bold text-red-800">
                    <span>TOTAL PENGELUARAN</span>
                    <span id="totalPengeluaran">Rp 0</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center border-t-4 border-double border-green-800 pt-8 px-6 md:px-8 text-2xl font-black text-gray-900 bg-green-50/30 rounded-b-2xl py-8 mt-12 shadow-sm">
                <span class="mb-2 sm:mb-0 uppercase">Saldo Akhir (Surplus)</span>
                <span id="surplus" class="text-green-700 text-3xl">Rp 0</span>
            </div>
        </div>
            
            <div class="mt-12 text-center border-t border-gray-100 pt-8">
                <p class="text-gray-500 italic md:px-12 leading-relaxed">
                    "Barangsiapa yang membangun masjid karena Allah, maka Allah akan membangunkan untuknya sebuah rumah di surga." <br>
                    <span class="font-bold text-gray-400 text-sm">(HR. Bukhari & Muslim)</span>
                </p>
                <p class="text-xs text-gray-400 mt-6">Terakhir diperbarui oleh Admin pada: 30 April 2026, 23:59 WIB</p>
            </div>
        </div>

    </main>

    @include('footer')
    <script>
        function formatRupiah(angka) {
            return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
        }

        document.getElementById('btnTampilkanLaporan').addEventListener('click', function () {
            const bulan = document.getElementById('filterBulan').value;
            const tahun = document.getElementById('filterTahun').value;

            fetch(`{{ route('public.keuangan.laporan') }}?bulan=${bulan}&tahun=${tahun}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('labelPeriode').textContent = 'Periode: ' + data.periode;

                    const listIn = document.getElementById('listPemasukan');
                listIn.innerHTML = data.pemasukan.length > 0 
                    ? data.pemasukan.map(t => `
                        <div class="flex justify-between text-gray-700 border-b border-gray-100 pb-3">
                            <span>${t.kategori ? t.kategori.nama : 'Lain-lain'}</span>
                            <span class="font-medium">${formatRupiah(t.nominal)}</span>
                        </div>
                    `).join('')
                    : '<p class="text-gray-400 text-sm italic text-center py-4">Belum ada penerimaan.</p>';

                const listOut = document.getElementById('listPengeluaran');
                listOut.innerHTML = data.pengeluaran.length > 0 
                    ? data.pengeluaran.map(t => `
                        <div class="flex justify-between text-gray-700 border-b border-gray-100 pb-3">
                            <span>${t.kategori ? t.kategori.nama : 'Lain-lain'}</span>
                            <span class="font-medium">${formatRupiah(t.nominal)}</span>
                        </div>
                    `).join('')
                    : '<p class="text-gray-400 text-sm italic text-center py-4">Belum ada pengeluaran.</p>';

                    document.getElementById('totalPemasukan').textContent = formatRupiah(data.totalPemasukan);
                    document.getElementById('totalPengeluaran').textContent = formatRupiah(data.totalPengeluaran);
                    
                    const surplusEl = document.getElementById('surplus');
                    surplusEl.textContent = formatRupiah(data.surplus);
                    surplusEl.className = data.surplus >= 0 ? 'text-green-700 text-3xl' : 'text-red-600 text-3xl';
                })
                .catch(err => alert("Gagal mengambil data laporan."));
        });

        window.onload = () => document.getElementById('btnTampilkanLaporan').click();
    </script>
    
</body>
</html>