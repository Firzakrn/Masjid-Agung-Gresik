<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Kategori Pemasukan --}}
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <h4 class="font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2 flex justify-between items-center">
            <span><i class="fa-solid fa-arrow-down text-green-600 mr-2"></i>Kategori Pendapatan</span>
            <button onclick="document.getElementById('formKategoriPemasukan').classList.toggle('hidden')"
                class="text-xs bg-green-50 text-green-600 px-2 py-1 rounded hover:bg-green-100 transition">
                <i class="fa-solid fa-plus"></i>
            </button>
        </h4>
        
        {{-- Form Tambah Kategori Pemasukan --}}
        <form id="formKategoriPemasukan" action="{{ route('admin.keuangan.tambahKategori') }}" method="POST" class="hidden mb-3 flex gap-2">
            @csrf
            <input type="hidden" name="jenis" value="pemasukan">
            <input type="text" name="nama" placeholder="Nama kategori..." class="flex-1 border border-slate-300 px-3 py-2 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-500" required>
            <button type="submit" class="bg-green-600 text-white px-3 py-2 rounded-lg text-sm font-bold">Simpan</button>
        </form>
        
        <ul class="space-y-2">
            @foreach($kategoriPemasukan as $kat)
            <li class="flex justify-between items-center p-2 hover:bg-slate-50 rounded border border-transparent hover:border-slate-100">
                <span class="text-sm font-bold text-slate-600">{{ $kat->nama }}</span>
                <form action="{{ route('admin.keuangan.hapusKategori', $kat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-400 hover:text-red-600">
                        <i class="fa-solid fa-trash-can text-xs"></i>
                    </button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>

    {{-- Kategori Pengeluaran --}}
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <h4 class="font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2 flex justify-between items-center">
            <span><i class="fa-solid fa-arrow-up text-red-600 mr-2"></i>Kategori Pengeluaran</span>
            <button onclick="document.getElementById('formKategoriPengeluaran').classList.toggle('hidden')"
                class="text-xs bg-red-50 text-red-600 px-2 py-1 rounded hover:bg-red-100 transition">
                <i class="fa-solid fa-plus"></i>
            </button>
        </h4>
        
        {{-- Form Tambah Kategori Pengeluaran --}}
        <form id="formKategoriPengeluaran" action="{{ route('admin.keuangan.tambahKategori') }}" method="POST" class="hidden mb-3 flex gap-2">
            @csrf
            <input type="hidden" name="jenis" value="pengeluaran">
            <input type="text" name="nama" placeholder="Nama kategori..." class="flex-1 border border-slate-300 px-3 py-2 rounded-lg text-sm outline-none focus:ring-2 focus:ring-green-500" required>
            <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm font-bold">Simpan</button>
        </form>
        
        <ul class="space-y-2">
            @foreach($kategoriPengeluaran as $kat)
            <li class="flex justify-between items-center p-2 hover:bg-slate-50 rounded border border-transparent hover:border-slate-100">
                <span class="text-sm font-bold text-slate-600">{{ $kat->nama }}</span>
                <form action="{{ route('admin.keuangan.hapusKategori', $kat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-400 hover:text-red-600">
                        <i class="fa-solid fa-trash-can text-xs"></i>
                    </button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>
</div>