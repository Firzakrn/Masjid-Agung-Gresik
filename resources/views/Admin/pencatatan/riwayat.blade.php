<div class="w-full max-w-6xl mx-auto transition-all duration-300">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-800">Riwayat Seluruh Transaksi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left text-sm">
                <thead class="bg-slate-50 text-slate-600 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">Tanggal</th>
                        <th class="px-6 py-4 whitespace-nowrap">No Reservasi</th>
                        <th class="px-6 py-4 whitespace-nowrap">Nama</th>
                        <th class="px-6 py-4 whitespace-nowrap">Kategori</th>
                        <th class="px-6 py-4 whitespace-nowrap">Keterangan</th>
                        <th class="px-6 py-4 whitespace-nowrap">Jenis</th>
                        <th class="px-6 py-4 whitespace-nowrap">Nominal</th>
                        <th class="px-6 py-4 whitespace-nowrap">Bukti</th>
                        <th class="px-6 py-4 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($riwayat as $trx)
                    <tr class="hover:bg-slate-50 transition baris-detail group" data-nama="{{ $trx->kategori->nama ?? '' }}">

                        {{-- Tanggal --}}
                        <td class="px-6 py-4 text-slate-500">
                            {{ \Carbon\Carbon::parse($trx->tanggal)->translatedFormat('d M Y') }}
                        </td>

                        {{-- No Reservasi --}}
                        <td class="px-6 py-4 text-slate-600 whitespace-nowrap">
                            @if($trx->reservasi_id)
                                <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded font-mono text-xs font-bold whitespace-nowrap">
                                    #RSV-{{ $trx->reservasi_id }}
                                </span>
                            @else
                                <span class="text-slate-300 text-xs">Manual</span>
                            @endif
                        </td>

                        {{-- Nama — hijau untuk semua pemasukan, merah untuk pengeluaran --}}
                        <td class="px-6 py-4">
                            @if($trx->reservasi_id)
                                @if($trx->jenis === 'pemasukan')
                                    <span class="text-green-600 font-semibold">{{ $trx->reservasi->nama_pemohon ?? '-' }}</span>
                                @else
                                    <span class="text-red-600 font-semibold">{{ $trx->reservasi->nama_pemohon ?? '-' }}</span>
                                @endif

                            @elseif($trx->jenis === 'pengeluaran')
                                @php
                                    preg_match('/Penerima:\s*([^|]+)/i', $trx->keterangan, $match);
                                    $namaPenerima = isset($match[1]) ? trim($match[1]) : '-';
                                @endphp
                                <span class="text-red-600 font-semibold">{{ $namaPenerima }}</span>

                            @else
                                @php
                                    if (preg_match('/Atas nama:\s*([^|]+)/i', $trx->keterangan, $match)) {
                                        $namaTampil = trim($match[1]);
                                    } elseif (preg_match('/Penyetor:\s*([^|]+)/i', $trx->keterangan, $match)) {
                                        $namaTampil = trim($match[1]);
                                    } else {
                                        $namaTampil = '-';
                                    }
                                @endphp
                                <span class="text-green-600 font-semibold">{{ $namaTampil }}</span>
                            @endif
                        </td>

                        {{-- Kategori --}}
                        <td class="px-6 py-4 font-bold text-slate-800">
                            {{ $trx->kategori->nama ?? '-' }}
                        </td>

                        {{-- Keterangan --}}
                        <td class="px-6 py-4 text-slate-600 max-w-xs truncate">
                            {{ $trx->keterangan }}
                        </td>

                        {{-- Jenis --}}
                        <td class="px-6 py-4">
                            @if($trx->jenis === 'pemasukan')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">Masuk</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">Keluar</span>
                            @endif
                        </td>

                        {{-- Nominal --}}
                        <td class="px-6 py-4 font-bold whitespace-nowrap {{ $trx->jenis === 'pemasukan' ? 'text-green-600' : 'text-red-500' }}">
                            {{ $trx->jenis === 'pengeluaran' ? '(' : '' }}
                            Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                            {{ $trx->jenis === 'pengeluaran' ? ')' : '' }}
                        </td>

                        {{-- Kolom Bukti --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($trx->bukti_bayar)
                                <button
                                    onclick="lihatBukti('{{ Storage::url($trx->bukti_bayar) }}', '{{ pathinfo($trx->bukti_bayar, PATHINFO_EXTENSION) }}')"
                                    class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-200 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                    <i class="fa-solid fa-eye text-xs"></i> Lihat Bukti
                                </button>
                            @else
                                <span class="text-slate-300 text-xs">—</span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                @if(!$trx->reservasi_id)
                                    @php
                                        $tanggalEdit = \Carbon\Carbon::parse($trx->tanggal)->format('Y-m-d');
                                    @endphp
                                    <button
                                        class="btn-edit-riwayat text-blue-500 hover:text-blue-700 transition text-xs px-2 py-1 rounded hover:bg-blue-50"
                                        data-id="{{ $trx->id }}"
                                        data-tanggal="{{ $tanggalEdit }}"
                                        data-kategori-id="{{ $trx->kategori_id ?? '' }}"
                                        data-nominal="{{ $trx->nominal }}"
                                        data-keterangan="{{ $trx->keterangan ?? '' }}"
                                        data-jenis="{{ $trx->jenis }}"
                                        title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                @endif
                                <button
                                    class="btn-hapus-riwayat text-red-400 hover:text-red-600 transition text-xs px-2 py-1 rounded hover:bg-red-50"
                                    data-id="{{ $trx->id }}"
                                    title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-slate-400 text-sm">
                            <i class="fa-solid fa-inbox text-2xl mb-2 block"></i>
                            Belum ada transaksi tercatat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ===== MODAL LIHAT BUKTI ===== -->
<div id="modalBukti" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 flex-shrink-0">
            <h3 class="text-base font-black text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-file-image text-blue-500"></i> Bukti Transfer
            </h3>
            <button onclick="tutupModalBukti()" class="text-slate-400 hover:text-slate-700 text-xl transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="flex-1 overflow-auto flex items-center justify-center p-4 bg-slate-50">
            {{-- Gambar --}}
            <img id="buktiGambar" src="" alt="Bukti Transfer"
                 class="hidden max-w-full max-h-[65vh] rounded-xl shadow object-contain">
            {{-- PDF --}}
            <iframe id="buktiPdf" src="" class="hidden w-full h-[65vh] rounded-xl border border-slate-200"></iframe>
            {{-- Fallback --}}
            <div id="buktiFallback" class="hidden text-center text-slate-500">
                <i class="fa-solid fa-file text-5xl mb-3 text-slate-300"></i>
                <p class="text-sm">Format file tidak dapat ditampilkan.</p>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-slate-100 flex justify-between items-center flex-shrink-0">
            <a id="buktiDownload" href="#" download
               class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-800 font-semibold transition">
                <i class="fa-solid fa-download"></i> Unduh File
            </a>
            <button onclick="tutupModalBukti()"
                    class="bg-slate-800 text-white px-5 py-2 rounded-lg text-sm font-bold hover:bg-slate-700 transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- ===== MODAL EDIT TRANSAKSI ===== -->
<div id="modalEditRiwayat" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 sticky top-0 bg-white z-10">
            <h3 class="text-base font-black text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-green-600"></i> Edit Transaksi
            </h3>
            <button onclick="tutupModalEditRiwayat()" class="text-slate-400 hover:text-slate-700 text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="px-6 py-5 space-y-4">
            <input type="hidden" id="editRiwayatId">
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal</label>
                <input id="editRiwayatTanggal" type="date" class="w-full mt-1 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-600 outline-none">
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</label>
                <select id="editRiwayatKategori" class="w-full mt-1 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-600 outline-none bg-white"></select>
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Nominal (Rp)</label>
                <input id="editRiwayatNominal" type="number" min="0" class="w-full mt-1 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-600 outline-none">
            </div>
            <div>
                <label id="editRiwayatLabelNama" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Penyetor</label>
                <input id="editRiwayatNamaPenyetor" type="text" placeholder="Contoh: Abdullah Ilham" class="w-full mt-1 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-600 outline-none">
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-2">Bentuk Transaksi</label>
                <div class="flex gap-4 p-3 bg-slate-50 border border-slate-200 rounded-lg">
                    <label class="flex items-center gap-2 font-bold cursor-pointer text-slate-700 text-sm">
                        <input type="radio" name="editRiwayatUang" value="Tunai" class="accent-green-600 w-4 h-4"> Tunai
                    </label>
                    <label class="flex items-center gap-2 font-bold cursor-pointer text-slate-700 text-sm">
                        <input type="radio" name="editRiwayatUang" value="Non Tunai" class="accent-red-600 w-4 h-4"> Non Tunai
                    </label>
                </div>
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Keterangan</label>
                <textarea id="editRiwayatKeterangan" rows="2" class="w-full mt-1 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-600 outline-none resize-none"></textarea>
            </div>
        </div>
        <div class="flex gap-3 px-6 py-4 border-t border-slate-200">
            <button onclick="simpanEditRiwayat()" class="flex-1 bg-slate-800 text-white py-2 rounded-lg text-sm font-bold hover:bg-slate-700 transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Simpan
            </button>
            <button onclick="tutupModalEditRiwayat()" class="flex-1 border border-slate-300 py-2 rounded-lg text-sm font-bold text-slate-600 hover:bg-slate-50 transition">
                Batal
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ============================================================
    // DATA KATEGORI
    // ============================================================
    const _kategoriRiwayat = {
        pemasukan:   @json($kategoriPemasukan),
        pengeluaran: @json($kategoriPengeluaran),
    };

    // ============================================================
    // MODAL LIHAT BUKTI
    // ============================================================
    function lihatBukti(url, ext) {
        const gambar   = document.getElementById('buktiGambar');
        const pdf      = document.getElementById('buktiPdf');
        const fallback = document.getElementById('buktiFallback');
        const download = document.getElementById('buktiDownload');

        // Reset semua
        gambar.classList.add('hidden');
        pdf.classList.add('hidden');
        fallback.classList.add('hidden');
        gambar.src = '';
        pdf.src    = '';

        download.href = url;
        const extLower = ext.toLowerCase();

        if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extLower)) {
            gambar.src = url;
            gambar.classList.remove('hidden');
        } else if (extLower === 'pdf') {
            pdf.src = url;
            pdf.classList.remove('hidden');
        } else {
            fallback.classList.remove('hidden');
        }

        document.getElementById('modalBukti').classList.remove('hidden');
    }

    function tutupModalBukti() {
        document.getElementById('modalBukti').classList.add('hidden');
        document.getElementById('buktiGambar').src = '';
        document.getElementById('buktiPdf').src    = '';
    }

    document.getElementById('modalBukti').addEventListener('click', function(e) {
        if (e.target === this) tutupModalBukti();
    });

    // ============================================================
    // PARSE KETERANGAN
    // ============================================================
    function parseKeteranganRiwayat(keterangan) {
        let ket = keterangan ?? '';
        let nama = '';
        let bentuk = '';
        const parts = ket.split(' | ');
        let ketBersih = [];

        parts.forEach(part => {
            if (part.startsWith('Penyetor: ')) {
                nama = part.replace('Penyetor: ', '');
            } else if (part.startsWith('Penerima: ')) {
                nama = part.replace('Penerima: ', '');
            } else if (part.startsWith('Via: ')) {
                bentuk = part.replace('Via: ', '');
            } else {
                ketBersih.push(part);
            }
        });

        return { keterangan: ketBersih.join(' | '), nama, bentuk };
    }

    let _jenisAktifRiwayat = 'pemasukan';

    // ============================================================
    // MODAL EDIT
    // ============================================================
    function bukaModalEditRiwayat(id, tanggal, kategoriId, nominal, keterangan, jenis) {
        _jenisAktifRiwayat = jenis;
        document.getElementById('editRiwayatId').value      = id;
        document.getElementById('editRiwayatTanggal').value = tanggal;
        document.getElementById('editRiwayatNominal').value = nominal;
        document.getElementById('editRiwayatLabelNama').textContent =
            jenis === 'pengeluaran' ? 'Nama Penerima' : 'Nama Penyetor';

        const parsed = parseKeteranganRiwayat(keterangan);
        document.getElementById('editRiwayatKeterangan').value   = parsed.keterangan;
        document.getElementById('editRiwayatNamaPenyetor').value = parsed.nama;

        document.querySelectorAll('input[name="editRiwayatUang"]').forEach(r => {
            r.checked = r.value === parsed.bentuk;
        });

        const daftarKat = _kategoriRiwayat[jenis] ?? [];
        document.getElementById('editRiwayatKategori').innerHTML = daftarKat.map(k =>
            `<option value="${k.id}" ${k.id == kategoriId ? 'selected' : ''}>${k.nama}</option>`
        ).join('');

        document.getElementById('modalEditRiwayat').classList.remove('hidden');
    }

    function tutupModalEditRiwayat() {
        document.getElementById('modalEditRiwayat').classList.add('hidden');
    }

    document.getElementById('modalEditRiwayat').addEventListener('click', function(e) {
        if (e.target === this) tutupModalEditRiwayat();
    });

    // ============================================================
    // SIMPAN EDIT
    // ============================================================
    function simpanEditRiwayat() {
        const id           = document.getElementById('editRiwayatId').value;
        const keteranganEl = document.getElementById('editRiwayatKeterangan').value.trim();
        const nama         = document.getElementById('editRiwayatNamaPenyetor').value.trim();
        const bentuk       = document.querySelector('input[name="editRiwayatUang"]:checked')?.value ?? '';
        const prefixNama   = _jenisAktifRiwayat === 'pengeluaran' ? 'Penerima: ' : 'Penyetor: ';

        let tambahan = [];
        if (nama)   tambahan.push(prefixNama + nama);
        if (bentuk) tambahan.push('Via: ' + bentuk);
        const keteranganFinal = (keteranganEl ? keteranganEl + (tambahan.length ? ' | ' : '') : '') + tambahan.join(' | ');

        fetch(`/admin/keuangan/transaksi/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                tanggal:     document.getElementById('editRiwayatTanggal').value,
                kategori_id: document.getElementById('editRiwayatKategori').value,
                nominal:     document.getElementById('editRiwayatNominal').value,
                keterangan:  keteranganFinal,
            }),
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                tutupModalEditRiwayat();
                window.location.reload();
            } else {
                alert('Gagal menyimpan.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan.');
        });
    }

    // ============================================================
    // HAPUS TRANSAKSI
    // ============================================================
    function hapusTransaksiRiwayat(id) {
        if (!confirm('Yakin ingin menghapus transaksi ini?')) return;

        fetch(`/admin/keuangan/transaksi/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const baris = document.querySelector(`.btn-hapus-riwayat[data-id="${id}"]`)?.closest('tr');
                if (baris) baris.remove();
            } else {
                alert('Gagal menghapus.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan.');
        });
    }

    // ============================================================
    // EVENT DELEGATION
    // ============================================================
    document.addEventListener('click', function (e) {
        const btnEdit = e.target.closest('.btn-edit-riwayat');
        if (btnEdit) {
            const d = btnEdit.dataset;
            bukaModalEditRiwayat(d.id, d.tanggal, d.kategoriId || null, d.nominal, d.keterangan, d.jenis);
            return;
        }

        const btnHapus = e.target.closest('.btn-hapus-riwayat');
        if (btnHapus) {
            hapusTransaksiRiwayat(btnHapus.dataset.id);
        }
    });

    // ============================================================
    // LIVE SEARCH
    // ============================================================
    function cariPemohon() {
        let inputEl = document.getElementById("searchInput");
        if (!inputEl) return;

        let input       = inputEl.value.toLowerCase();
        let barisGrup   = document.getElementsByClassName("baris-grup");
        let barisDetail = document.getElementsByClassName("baris-detail");

        for (let i = 0; i < barisGrup.length; i++) {
            barisGrup[i].style.display = "none";
        }

        for (let i = 0; i < barisDetail.length; i++) {
            let namaPemohon = barisDetail[i].cells[2].textContent.toLowerCase();
            let namaAkun    = barisDetail[i].getAttribute("data-nama");
            if (namaAkun) namaAkun = namaAkun.toLowerCase();

            if (namaPemohon.includes(input) || (namaAkun && namaAkun.includes(input))) {
                barisDetail[i].style.display = "";
                for (let j = 0; j < barisGrup.length; j++) {
                    if (barisGrup[j].getAttribute("data-nama") &&
                        barisGrup[j].getAttribute("data-nama").toLowerCase() === namaAkun) {
                        barisGrup[j].style.display = "";
                        break;
                    }
                }
            } else {
                barisDetail[i].style.display = "none";
            }
        }
    }

    let searchInput = document.getElementById('searchInput');
    if (searchInput) searchInput.addEventListener('keyup', cariPemohon);
</script>
@endpush