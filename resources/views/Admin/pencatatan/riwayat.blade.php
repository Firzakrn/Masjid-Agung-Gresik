<div class="w-full max-w-6xl mx-auto transition-all duration-300">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-800">Riwayat Seluruh Transaksi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead class="bg-slate-50 text-slate-600 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">Tanggal</th>
                        <th class="px-6 py-4 whitespace-nowrap">No Reservasi</th>
                        <th class="px-6 py-4 whitespace-nowrap">Nama</th>
                        <th class="px-6 py-4 whitespace-nowrap">Kategori</th>
                        <th class="px-6 py-4 whitespace-nowrap">Keterangan</th>
                        <th class="px-6 py-4 whitespace-nowrap">Jenis</th>
                        <th class="px-6 py-4 whitespace-nowrap">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($riwayat as $trx)
                    <tr class="hover:bg-slate-50 transition baris-detail" data-nama="{{ $trx->kategori->nama ?? '' }}">
                        <td class="px-6 py-4 text-slate-500">
                            {{ \Carbon\Carbon::parse($trx->tanggal)->translatedFormat('d M Y') }}
                        </td>
                        {{-- No Reservasi — ambil dari relasi reservasi --}}
                        <td class="px-6 py-4 text-slate-600 whitespace-nowrap">
                            @if($trx->reservasi_id)
                                <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded font-mono text-xs font-bold whitespace-nowrap">
                                    #RSV-{{ $trx->reservasi_id }}
                                </span>
                            @else
                                <span class="text-slate-300 text-xs">Manual</span>
                            @endif
                        </td>
                        {{-- Nama Pemohon — ambil dari relasi reservasi --}}
                        <td class="px-6 py-4 text-slate-700">
                            {{ $trx->reservasi->nama_pemohon ?? '-' }}
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-800">
                            {{ $trx->kategori->nama ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-slate-600 max-w-xs truncate">
                            {{ $trx->keterangan }}
                        </td>
                        <td class="px-6 py-4">
                            @if($trx->jenis === 'pemasukan')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">Masuk</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">Keluar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold whitespace-nowrap {{ $trx->jenis === 'pemasukan' ? 'text-green-600' : 'text-red-500' }}">
                            {{ $trx->jenis === 'pengeluaran' ? '(' : '' }}
                            Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                            {{ $trx->jenis === 'pengeluaran' ? ')' : '' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-slate-400 text-sm">
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

@push('scripts')
<script>
    // ============================================================
    // FUNGSI UNTUK LIVE SEARCH (Cari Nama Pemohon / Nama Akun)
    // ============================================================
    function cariPemohon() {
        let inputEl = document.getElementById("searchInput");
        if (!inputEl) return; // Mencegah error jika input pencarian belum ada
        
        let input = inputEl.value.toLowerCase();
        let barisGrup = document.getElementsByClassName("baris-grup");
        let barisDetail = document.getElementsByClassName("baris-detail");
        
        // 1. Sembunyikan semua baris grup (Header Nama Akun) dari awal
        for (let i = 0; i < barisGrup.length; i++) {
            barisGrup[i].style.display = "none";
        }

        // 2. Loop semua baris detail transaksi
        for (let i = 0; i < barisDetail.length; i++) {
            // Ambil teks Nama Pemohon dari kolom ke-3 (index ke-2)
            let namaPemohon = barisDetail[i].cells[2].textContent.toLowerCase();
            
            // Ambil Nama Akun dari atribut data-nama
            let namaAkun = barisDetail[i].getAttribute("data-nama");
            if(namaAkun) namaAkun = namaAkun.toLowerCase();

            // Jika Nama Pemohon ATAU Nama Akun cocok dengan ketikan user
            if (namaPemohon.includes(input) || (namaAkun && namaAkun.includes(input))) {
                barisDetail[i].style.display = ""; // Tampilkan baris detail
                
                // Munculkan kembali Header Grup yang sesuai dengan baris ini
                for (let j = 0; j < barisGrup.length; j++) {
                    if (barisGrup[j].getAttribute("data-nama") && barisGrup[j].getAttribute("data-nama").toLowerCase() === namaAkun) {
                        barisGrup[j].style.display = "";
                        break;
                    }
                }
            } else {
                barisDetail[i].style.display = "none"; // Sembunyikan jika tidak cocok
            }
        }
    }

    // Jika ada input search, pasang event listener-nya
    let searchInput = document.getElementById('searchInput');
    if(searchInput) {
        searchInput.addEventListener('keyup', cariPemohon);
    }
</script>
@endpush