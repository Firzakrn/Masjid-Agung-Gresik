<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Keuangan | Admin Masjid</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .hide-scroll-bar::-webkit-scrollbar { display: none; }
        .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100 font-sans flex h-screen overflow-hidden">

    @include('admin.navbarAdm')

    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50 relative">
        
        <header class="md:hidden bg-green-900 text-white p-4 flex justify-between items-center flex-shrink-0">
            <h1 class="text-lg font-bold"><i class="fa-solid fa-mosque"></i> Admin Masjid</h1>
            <button class="text-white"><i class="fa-solid fa-bars text-xl"></i></button>
        </header>

        <div class="flex-1 overflow-y-auto relative p-6 md:p-10" id="scrollArea">
            
            <div id="mainHeader" class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Pencatatan Keuangan</h2>
                    <p class="text-gray-500 text-sm mt-1">Laporan arus kas dan kelola transaksi masjid.</p>
                </div>
                
                <div class="flex flex-wrap gap-3 w-full md:w-auto">
                    <button id="btnKelolaAkun" class="flex-1 md:flex-none border-2 border-green-700 text-green-700 hover:bg-green-50 px-4 py-2 rounded-lg font-semibold transition flex items-center justify-center gap-2 text-sm">
                        <i class="fa-solid fa-folder-open"></i> Kelola Akun
                    </button>
                    <button id="btnRiwayat" class="flex-1 md:flex-none border-2 border-blue-600 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg font-semibold transition flex items-center justify-center gap-2 text-sm">
                        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Transaksi
                    </button>
                    <button id="btnTambahTransaksi" class="flex-1 md:flex-none bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg font-semibold transition flex items-center justify-center gap-2 text-sm shadow-md">
                        <i class="fa-solid fa-plus"></i> Tambah Transaksi
                    </button>
                </div>
            </div>

            <div id="reportView" class="w-full max-w-5xl mx-auto transition-all duration-300">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-4 items-center mb-6">
                    <span class="text-sm font-bold text-gray-600"><i class="fa-solid fa-filter text-green-600 mr-1"></i> Filter Laporan:</span>
                    <select class="bg-gray-50 border border-gray-300 px-4 py-2 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 w-full md:w-48">
                        <option value="04" selected>April</option>
                        <option value="05">Mei</option>
                    </select>
                    <select class="bg-gray-50 border border-gray-300 px-4 py-2 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 w-full md:w-32">
                        <option value="2026" selected>2026</option>
                        <option value="2025">2025</option>
                    </select>
                    <button class="bg-gray-800 text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-gray-700 transition w-full md:w-auto">Tampilkan</button>
                </div>

                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8 md:p-12">
                    <div class="text-center border-b-2 border-black pb-4 mb-8">
                        <h2 class="text-2xl font-bold uppercase tracking-wide text-gray-800">Laporan Arus Kas (Laba Rugi)</h2>
                        <h3 class="text-lg font-semibold text-gray-600">Masjid Agung Gresik</h3>
                        <p class="text-sm text-gray-500 mt-1">Periode: 1 April 2026 - 30 April 2026</p>
                    </div>

                    <div class="mb-8">
                        <h4 class="font-bold text-lg text-green-800 border-b border-gray-200 pb-2 mb-4">PENDAPATAN (PEMASUKAN)</h4>
                        <div class="space-y-3 px-4">
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Kotak Amal Jumat (Offline)</span><span class="font-medium">Rp 35.450.000</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Kotak Amal Harian (Offline)</span><span class="font-medium">Rp 12.300.000</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Infaq via QRIS / Bank Transfer (Online)</span><span class="font-medium">Rp 28.750.000</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Donasi Khusus Pembangunan Masjid</span><span class="font-medium">Rp 15.000.000</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Penerimaan Zakat Maal & Fitrah</span><span class="font-medium">Rp 45.000.000</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Penerimaan Fidyah & Kifarat</span><span class="font-medium">Rp 3.200.000</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Sewa Gedung Serbaguna & Lapangan</span><span class="font-medium">Rp 8.500.000</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Infaq Parkir Kendaraan</span><span class="font-medium">Rp 4.100.000</span></div>
                        </div>
                        <div class="flex justify-between items-center mt-4 px-4 py-3 bg-green-50 rounded-lg border border-green-100 font-bold text-green-900 shadow-inner">
                            <span>TOTAL PENDAPATAN</span><span class="text-xl tracking-wide">Rp 152.300.000</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h4 class="font-bold text-lg text-red-700 border-b border-gray-200 pb-2 mb-4">PENGELUARAN (BEBAN)</h4>
                        <div class="space-y-3 px-4">
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Biaya Operasional (Listrik, PDAM)</span><span class="font-medium">( Rp 6.800.000 )</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Biaya Internet & Telepon</span><span class="font-medium">( Rp 1.200.000 )</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Bisyaroh / Honor Imam & Khotib Jumat</span><span class="font-medium">( Rp 5.500.000 )</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Honor Marbot, Security & Kebersihan</span><span class="font-medium">( Rp 12.000.000 )</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Santunan Anak Yatim & Dhuafa</span><span class="font-medium">( Rp 25.000.000 )</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Biaya Konsumsi Kajian Rutin</span><span class="font-medium">( Rp 3.400.000 )</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Pemeliharaan Bangunan (Renovasi Toilet)</span><span class="font-medium">( Rp 18.500.000 )</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Pembelian Perlengkapan (Karpet, Sound)</span><span class="font-medium">( Rp 7.300.000 )</span></div>
                            <div class="flex justify-between text-gray-700 hover:bg-gray-50 p-1 rounded transition"><span>Operasional Pendidikan (TPQ)</span><span class="font-medium">( Rp 4.500.000 )</span></div>
                        </div>
                        <div class="flex justify-between items-center mt-4 px-4 py-3 bg-red-50 rounded-lg border border-red-100 font-bold text-red-800 shadow-inner">
                            <span>TOTAL PENGELUARAN</span><span class="text-xl tracking-wide">( Rp 84.200.000 )</span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center border-t-4 border-double border-gray-800 pt-6 px-6 text-2xl font-black text-gray-900 bg-gray-100 rounded-b-xl py-6 mt-10 shadow-sm">
                        <span class="mb-2 sm:mb-0">DANA BERSIH / SURPLUS</span><span class="text-green-700">Rp 68.100.000</span>
                    </div>
                </div>
            </div>

            <div id="historyView" class="hidden w-full max-w-6xl mx-auto transition-all duration-300">
                <div class="flex justify-between items-center mb-6">
                    <button class="btnBack text-gray-600 hover:text-green-700 font-bold flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Laporan
                    </button>
                    <h3 class="text-xl font-bold text-gray-800">Riwayat Seluruh Transaksi</h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4 font-bold">Tanggal</th>
                                <th class="px-6 py-4 font-bold">Kategori</th>
                                <th class="px-6 py-4 font-bold">Jenis</th>
                                <th class="px-6 py-4 font-bold">Nominal</th>
                                <th class="px-6 py-4 font-bold">Keterangan/Memo</th>
                                <th class="px-6 py-4 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">18 Apr 2026</td>
                                <td class="px-6 py-4 font-bold text-gray-800">Kotak Amal Jumat</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-[10px] font-bold uppercase italic">Masuk</span></td>
                                <td class="px-6 py-4 font-bold text-green-700">Rp 8.450.000</td>
                                <td class="px-6 py-4 italic text-gray-400">Penghitungan ba'da Jumat (Pekan 3)</td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <button class="w-8 h-8 rounded bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button onclick="return confirm('Yakin ingin menghapus?')" class="w-8 h-8 rounded bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition"><i class="fa-solid fa-trash-can"></i></button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">15 Apr 2026</td>
                                <td class="px-6 py-4 font-bold text-gray-800">Biaya Listrik & Air</td>
                                <td class="px-6 py-4"><span class="bg-red-100 text-red-700 px-2 py-1 rounded-md text-[10px] font-bold uppercase italic">Keluar</span></td>
                                <td class="px-6 py-4 font-bold text-red-700">Rp 6.800.000</td>
                                <td class="px-6 py-4 italic text-gray-400">Tagihan PLN & PDAM Bulan April</td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <button class="w-8 h-8 rounded bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button onclick="return confirm('Yakin ingin menghapus?')" class="w-8 h-8 rounded bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition"><i class="fa-solid fa-trash-can"></i></button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">10 Apr 2026</td>
                                <td class="px-6 py-4 font-bold text-gray-800">Infaq Online</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-[10px] font-bold uppercase italic">Masuk</span></td>
                                <td class="px-6 py-4 font-bold text-green-700">Rp 500.000</td>
                                <td class="px-6 py-4 italic text-gray-400">Hamba Allah - via QRIS</td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <button class="w-8 h-8 rounded bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button onclick="return confirm('Yakin ingin menghapus?')" class="w-8 h-8 rounded bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition"><i class="fa-solid fa-trash-can"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="formView" class="hidden w-full max-w-3xl mx-auto transition-all duration-300">
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8">
                    <button class="btnBack text-gray-400 hover:text-gray-600 text-sm mb-4"><i class="fa-solid fa-arrow-left mr-1"></i> Batal & Kembali</button>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b border-gray-100 pb-4">Catat Transaksi Baru</h2>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal *</label>
                            <input type="date" name="tanggal" class="w-full bg-gray-50 border border-gray-300 px-4 py-3 rounded-lg text-sm" required />
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-3">Jenis *</label>
                            <div class="flex gap-4 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                <label class="flex items-center gap-2 font-bold cursor-pointer text-gray-700 hover:text-green-700"><input type="radio" name="jt" id="radio_pemasukan" value="pemasukan" class="accent-green-600 w-5 h-5"> Pemasukan</label>
                                <label class="flex items-center gap-2 font-bold cursor-pointer text-gray-700 hover:text-red-700"><input type="radio" name="jt" id="radio_pengeluaran" value="pengeluaran" class="accent-red-600 w-5 h-5"> Pengeluaran</label>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori *</label>
                            <select id="kategori_akun" class="w-full border border-gray-300 px-4 py-3 rounded-lg text-sm bg-white" disabled required>
                                <option value="" disabled selected>Pilih jenis transaksi dulu...</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nominal (Rp) *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><span class="text-gray-500 font-bold font-mono">Rp</span></div>
                                <input type="number" name="nom" class="w-full bg-gray-50 border border-gray-300 pl-12 pr-4 py-3 rounded-lg font-bold text-lg" placeholder="0" required />
                            </div>
                        </div>
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Memo / Keterangan</label>
                            <textarea name="memo" rows="3" class="w-full border border-gray-300 bg-gray-50 px-4 py-3 rounded-lg text-sm" placeholder="Catatan tambahan..."></textarea>
                        </div>
                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" class="btnBack px-6 py-3 border border-gray-300 rounded-lg text-gray-600 font-bold hover:bg-gray-100 transition">Batal</button>
                            <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-10 py-3 rounded-lg font-bold shadow-md transition">Simpan Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="accountView" class="hidden w-full max-w-5xl mx-auto transition-all duration-300">
                <div class="flex justify-between items-center mb-6">
                    <button class="btnBack text-gray-600 hover:text-green-700 font-bold flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Laporan
                    </button>
                    <button class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md flex items-center gap-2 transition">
                        <i class="fa-solid fa-plus"></i> Tambah Kategori
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-xl border border-green-100 shadow-sm">
                        <h4 class="font-bold text-green-800 mb-4 border-b pb-2"><i class="fa-solid fa-arrow-down mr-2"></i>Kategori Pendapatan</h4>
                        <ul class="space-y-2">
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                                <span class="text-sm font-semibold text-gray-700">Kotak Amal Jumat (Offline)</span>
                                <div class="flex gap-2">
                                    <button class="w-7 h-7 rounded bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition"><i class="fa-solid fa-pen text-xs"></i></button>
                                    <button onclick="return confirm('Yakin hapus?')" class="w-7 h-7 rounded bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition"><i class="fa-solid fa-trash-can text-xs"></i></button>
                                </div>
                            </li>
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                                <span class="text-sm font-semibold text-gray-700">Infaq via QRIS (Online)</span>
                                <div class="flex gap-2">
                                    <button class="w-7 h-7 rounded bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition"><i class="fa-solid fa-pen text-xs"></i></button>
                                    <button onclick="return confirm('Yakin hapus?')" class="w-7 h-7 rounded bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition"><i class="fa-solid fa-trash-can text-xs"></i></button>
                                </div>
                            </li>
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                                <span class="text-sm font-semibold text-gray-700">Zakat Maal & Fitrah</span>
                                <div class="flex gap-2">
                                    <button class="w-7 h-7 rounded bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition"><i class="fa-solid fa-pen text-xs"></i></button>
                                    <button onclick="return confirm('Yakin hapus?')" class="w-7 h-7 rounded bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition"><i class="fa-solid fa-trash-can text-xs"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-red-100 shadow-sm">
                        <h4 class="font-bold text-red-800 mb-4 border-b pb-2"><i class="fa-solid fa-arrow-up mr-2"></i>Kategori Pengeluaran</h4>
                        <ul class="space-y-2">
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                                <span class="text-sm font-semibold text-gray-700">Biaya Operasional (Listrik, Air)</span>
                                <div class="flex gap-2">
                                    <button class="w-7 h-7 rounded bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition"><i class="fa-solid fa-pen text-xs"></i></button>
                                    <button onclick="return confirm('Yakin hapus?')" class="w-7 h-7 rounded bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition"><i class="fa-solid fa-trash-can text-xs"></i></button>
                                </div>
                            </li>
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                                <span class="text-sm font-semibold text-gray-700">Bisyaroh Khotib & Imam</span>
                                <div class="flex gap-2">
                                    <button class="w-7 h-7 rounded bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition"><i class="fa-solid fa-pen text-xs"></i></button>
                                    <button onclick="return confirm('Yakin hapus?')" class="w-7 h-7 rounded bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition"><i class="fa-solid fa-trash-can text-xs"></i></button>
                                </div>
                            </li>
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                                <span class="text-sm font-semibold text-gray-700">Pemeliharaan Bangunan</span>
                                <div class="flex gap-2">
                                    <button class="w-7 h-7 rounded bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition"><i class="fa-solid fa-pen text-xs"></i></button>
                                    <button onclick="return confirm('Yakin hapus?')" class="w-7 h-7 rounded bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition"><i class="fa-solid fa-trash-can text-xs"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div> 
    </main>

    <script>
        const views = {
            report: document.getElementById('reportView'),
            history: document.getElementById('historyView'),
            form: document.getElementById('formView'),
            account: document.getElementById('accountView')
        };
        const header = document.getElementById('mainHeader');

        function showView(viewKey) {
            Object.values(views).forEach(v => v.classList.add('hidden'));
            views[viewKey].classList.remove('hidden');
            
            if(viewKey === 'report') header.classList.remove('hidden');
            else header.classList.add('hidden');
            
            document.getElementById('scrollArea').scrollTop = 0;
        }

        document.getElementById('btnRiwayat').onclick = () => showView('history');
        document.getElementById('btnTambahTransaksi').onclick = () => showView('form');
        document.getElementById('btnKelolaAkun').onclick = () => showView('account');
        
        document.querySelectorAll('.btnBack').forEach(btn => {
            btn.onclick = () => showView('report');
        });

        // Dropdown Dinamis Pemasukan/Pengeluaran
        const radioIn = document.getElementById('radio_pemasukan');
        const radioOut = document.getElementById('radio_pengeluaran');
        const katSelect = document.getElementById('kategori_akun');

        radioIn.onchange = () => {
            katSelect.disabled = false;
            katSelect.innerHTML = `
                <option value="" disabled selected>Pilih Kategori Pemasukan...</option>
                <option value="jumat">Kotak Amal Jumat (Offline)</option>
                <option value="harian">Kotak Amal Harian (Offline)</option>
                <option value="qris">Infaq via QRIS / Bank (Online)</option>
                <option value="pembangunan">Donasi Pembangunan</option>
                <option value="zakat">Zakat Maal & Fitrah</option>
                <option value="sewa">Sewa Gedung / Lapangan</option>
            `;
        };
        radioOut.onchange = () => {
            katSelect.disabled = false;
            katSelect.innerHTML = `
                <option value="" disabled selected>Pilih Kategori Pengeluaran...</option>
                <option value="listrik">Biaya Operasional (Listrik, PDAM)</option>
                <option value="honor">Bisyaroh / Honor Imam & Khotib</option>
                <option value="gaji">Honor Marbot & Keamanan</option>
                <option value="yatim">Santunan Anak Yatim & Dhuafa</option>
                <option value="renovasi">Pemeliharaan Bangunan (Renovasi)</option>
            `;
        };
    </script>
</body>
</html>