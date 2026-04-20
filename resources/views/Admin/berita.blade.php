<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Berita | Admin Masjid</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .hide-scroll-bar::-webkit-scrollbar { display: none; }
        .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100 font-sans flex h-screen overflow-hidden">

    @include('Admin.navbarAdm')
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50 relative">
        
        <header class="md:hidden bg-green-900 text-white p-4 flex justify-between items-center flex-shrink-0">
            <h1 class="text-lg font-bold"><i class="fa-solid fa-mosque"></i> Admin Masjid</h1>
            <button class="text-white"><i class="fa-solid fa-bars text-xl"></i></button>
        </header>

        <div class="flex-1 overflow-y-auto relative" id="scrollArea">
            
            <div id="listView" class="p-6 md:p-10 w-full max-w-6xl mx-auto transition-all duration-300">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Daftar Berita & Kegiatan</h2>
                        <p class="text-gray-500 text-sm mt-1">Kelola publikasi informasi masjid.</p>
                    </div>
                    
                    <div class="flex gap-3">
                        <button id="btnToggleHapus" class="border-2 border-red-500 text-red-500 hover:bg-red-50 px-4 py-2 rounded-lg font-semibold transition flex items-center gap-2 text-sm">
                            <i class="fa-solid fa-trash-can"></i> Hapus
                        </button>
                        <button id="btnTambah" class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg font-semibold transition flex items-center gap-2 text-sm shadow-md">
                            <i class="fa-solid fa-plus"></i> Tambah Berita
                        </button>
                    </div>
                </div>

                <div id="stickyHapusBar" class="hidden sticky top-0 z-50 bg-red-600 text-white p-4 rounded-xl shadow-lg mb-6 flex justify-between items-center transition-all duration-300">
                    <div class="flex items-center gap-3">
                        <span class="bg-white text-red-600 font-bold px-3 py-1 rounded-full text-sm" id="hapusCount">0 terpilih</span>
                        <span class="font-medium">Pilih berita yang ingin dihapus.</span>
                    </div>
                    <div class="flex gap-2">
                        <button id="btnBatalHapus" class="bg-red-500 hover:bg-red-400 px-4 py-2 rounded-lg text-sm font-bold transition">Batal</button>
                        <button id="btnKonfirmasiHapus" class="bg-white text-red-600 hover:bg-gray-100 px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition flex items-center gap-2">
                            <i class="fa-solid fa-trash-can"></i> Hapus
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <ul class="divide-y divide-gray-100" id="beritaList">
                        
                        <li class="p-5 hover:bg-gray-50 transition flex items-center gap-4 group">
                            <input type="checkbox" class="delete-checkbox hidden w-5 h-5 text-red-600 rounded cursor-pointer accent-red-600 flex-shrink-0">
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 rounded uppercase">Berita</span>
                                    <span class="text-xs text-gray-400"><i class="fa-regular fa-clock"></i> 10 Apr 2026</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 truncate">Persiapan Menyambut Bulan Suci Ramadhan di Masjid Agung</h3>
                            </div>
                            
                            <button class="w-10 h-10 rounded-full bg-green-50 text-green-600 hover:bg-green-600 hover:text-white flex items-center justify-center transition flex-shrink-0 shadow-sm border border-green-100">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </li>

                        <li class="p-5 hover:bg-gray-50 transition flex items-center gap-4 group">
                            <input type="checkbox" class="delete-checkbox hidden w-5 h-5 text-red-600 rounded cursor-pointer accent-red-600 flex-shrink-0">
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="bg-purple-100 text-purple-700 text-xs font-bold px-2 py-0.5 rounded uppercase">Kegiatan</span>
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded">Kajian Kitab</span>
                                    <span class="text-xs text-gray-400"><i class="fa-regular fa-clock"></i> 09 Apr 2026</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 truncate">Kajian Kitab Tafsir Jalalain Bersama KH. Ahmad Fauzi</h3>
                            </div>
                            
                            <button class="w-10 h-10 rounded-full bg-green-50 text-green-600 hover:bg-green-600 hover:text-white flex items-center justify-center transition flex-shrink-0 shadow-sm border border-green-100">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </li>

                        <li class="p-5 hover:bg-gray-50 transition flex items-center gap-4 group">
                            <input type="checkbox" class="delete-checkbox hidden w-5 h-5 text-red-600 rounded cursor-pointer accent-red-600 flex-shrink-0">
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="bg-purple-100 text-purple-700 text-xs font-bold px-2 py-0.5 rounded uppercase">Kegiatan</span>
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded">Agenda</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 truncate">Peringatan Nuzulul Qur'an 1447 H</h3>
                            </div>
                            
                            <button class="w-10 h-10 rounded-full bg-green-50 text-green-600 hover:bg-green-600 hover:text-white flex items-center justify-center transition flex-shrink-0 shadow-sm border border-green-100">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="formView" class="hidden p-6 md:p-10 w-full max-w-4xl mx-auto transition-all duration-300">
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b border-gray-100 pb-4">Tulis Publikasi Baru</h2>
                    
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Utama *</label>
                                <select id="inputKategori" name="kategori" class="w-full bg-gray-50 border border-gray-300 px-4 py-3 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600" required>
                                    <option value="" disabled selected>Pilih Kategori...</option>
                                    <option value="berita">Berita</option>
                                    <option value="kegiatan">Kegiatan</option>
                                </select>
                            </div>

                            <div id="wrapperSubKategori" class="hidden">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kegiatan *</label>
                                <select name="sub_kategori" class="w-full bg-gray-50 border border-gray-300 px-4 py-3 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600">
                                    <option value="" disabled selected>Pilih Jenis Kegiatan...</option>
                                    <option value="agenda">Agenda</option>
                                    <option value="kajian_kitab">Kajian Kitab</option>
                                    <option value="kajian_rutin">Kajian Rutin</option>
                                    <option value="pendidikan">Pendidikan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Unggah Foto (Opsional)</label>
                            <input type="file" name="foto" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 border border-gray-300 rounded-lg bg-gray-50 cursor-pointer">
                            <p class="text-xs text-gray-400 mt-1">Format yang disarankan: JPG, PNG. Maksimal 2MB.</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Judul *</label>
                            <input type="text" name="judul" placeholder="Masukkan judul..." class="w-full bg-gray-50 border border-gray-300 px-4 py-3 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600" required />
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Isi Berita/Keterangan *</label>
                            <textarea name="isi_konten" rows="8" placeholder="Tulis rincian konten di sini..." class="w-full bg-gray-50 border border-gray-300 px-4 py-3 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-600 resize-y" required></textarea>
                        </div>

                        <div class="flex justify-end gap-4 border-t border-gray-100 pt-6">
                            <button type="button" id="btnBatalForm" class="px-6 py-3 rounded-lg text-gray-600 font-bold hover:bg-gray-100 transition border border-gray-300">
                                Batal
                            </button>
                            <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-8 py-3 rounded-lg font-bold shadow-md transition flex items-center gap-2">
                                <i class="fa-solid fa-save"></i> Simpan Publikasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div> </main>

    <script>
        // --- LOGIKA FORM TAMBAH ---
        const listView = document.getElementById('listView');
        const formView = document.getElementById('formView');
        const btnTambah = document.getElementById('btnTambah');
        const btnBatalForm = document.getElementById('btnBatalForm');
        
        // Logika Dropdown Kategori & Sub-Kategori
        const inputKategori = document.getElementById('inputKategori');
        const wrapperSubKategori = document.getElementById('wrapperSubKategori');

        // Buka form tambah
        btnTambah.addEventListener('click', () => {
            listView.classList.add('hidden');
            formView.classList.remove('hidden');
        });

        // Tutup form tambah
        btnBatalForm.addEventListener('click', () => {
            formView.classList.add('hidden');
            listView.classList.remove('hidden');
            // Opsional: scroll kembali ke atas
            document.getElementById('scrollArea').scrollTop = 0;
        });

        // Tampilkan sub-kategori jika 'Kegiatan' dipilih
        inputKategori.addEventListener('change', function() {
            if (this.value === 'kegiatan') {
                wrapperSubKategori.classList.remove('hidden');
                wrapperSubKategori.querySelector('select').required = true;
            } else {
                wrapperSubKategori.classList.add('hidden');
                wrapperSubKategori.querySelector('select').required = false;
                wrapperSubKategori.querySelector('select').value = ""; // Reset value
            }
        });


        // --- LOGIKA MODE HAPUS (FREEZE EXCEL) ---
        const btnToggleHapus = document.getElementById('btnToggleHapus');
        const stickyHapusBar = document.getElementById('stickyHapusBar');
        const btnBatalHapus = document.getElementById('btnBatalHapus');
        const btnKonfirmasiHapus = document.getElementById('btnKonfirmasiHapus');
        const hapusCount = document.getElementById('hapusCount');
        const checkboxes = document.querySelectorAll('.delete-checkbox');
        let deleteModeActive = false;

        function updateHapusCount() {
            const checkedCount = document.querySelectorAll('.delete-checkbox:checked').length;
            hapusCount.innerText = `${checkedCount} terpilih`;
        }

        function toggleModeHapus(active) {
            deleteModeActive = active;
            checkboxes.forEach(cb => {
                if (active) {
                    cb.classList.remove('hidden');
                } else {
                    cb.classList.add('hidden');
                    cb.checked = false; // Uncheck semua saat batal
                }
            });
            
            if (active) {
                stickyHapusBar.classList.remove('hidden');
                btnToggleHapus.classList.add('hidden');
                btnTambah.classList.add('hidden');
            } else {
                stickyHapusBar.classList.add('hidden');
                btnToggleHapus.classList.remove('hidden');
                btnTambah.classList.remove('hidden');
            }
            updateHapusCount();
        }

        // Klik tombol "Mode Hapus"
        btnToggleHapus.addEventListener('click', () => toggleModeHapus(true));
        
        // Klik tombol "Batal" di sticky bar
        btnBatalHapus.addEventListener('click', () => toggleModeHapus(false));

        // Update teks jumlah saat checkbox diklik
        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateHapusCount);
        });

        // Simulasi Eksekusi Hapus
        btnKonfirmasiHapus.addEventListener('click', () => {
            const checkedCount = document.querySelectorAll('.delete-checkbox:checked').length;
            if (checkedCount === 0) {
                alert('Pilih minimal 1 berita untuk dihapus!');
                return;
            }
            if(confirm(`Yakin ingin menghapus ${checkedCount} berita secara permanen?`)) {
                // Di sini nanti diletakkan logika submit form ke Laravel (destroy)
                alert('Berhasil dihapus! (Simulasi)');
                toggleModeHapus(false);
            }
        });
    </script>
</body>
</html>