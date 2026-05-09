<div class="w-full max-w-7xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-blue-50/30">
            <div>
                <h3 class="text-lg font-bold text-slate-800">Database Data Reserver</h3>
                <p class="text-xs text-slate-500">Daftar reservasi jamaah yang dikelompokkan per individu.</p>
            </div>
            <div class="relative w-full md:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-search text-slate-400"></i>
                </div>
                {{-- Fungsi JS cariPemohon() sudah ada di file induk (pencatatan.blade.php) --}}
                <input type="text" id="searchInput" onkeyup="cariPemohon()" class="w-full bg-white border border-slate-300 pl-10 pr-4 py-2.5 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-500 shadow-sm transition" placeholder="Cari nama jamaah...">
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left text-sm" id="tabelReserver">
                <thead class="bg-slate-50 text-slate-600 uppercase text-[11px] font-bold border-b border-slate-200 tracking-wide">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">Tanggal Reservasi</th>
                        <th class="px-4 py-4 whitespace-nowrap">No Reservasi</th>
                        <th class="px-4 py-4 whitespace-nowrap">Nama Pemohon</th>
                        <th class="px-4 py-4 whitespace-nowrap text-center">Data Pemohon & Acara</th>
                        <th class="px-4 py-4 whitespace-nowrap">Keterangan</th>
                        <th class="px-6 py-4 whitespace-nowrap text-right">Nominal Transaksi (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    {{-- KELOMPOKKAN DATA BERDASARKAN NAMA AKUN JAMAAH (Pakai optional untuk keamanan) --}}
                    @forelse($semuaReservasi->groupBy(function($item) { return optional($item->user)->name ?? 'Tanpa Nama'; }) as $namaJamaah => $grupRsv)
                    
                        {{-- BARIS HEADER GRUP: NAMA AKUN JAMAAH --}}
                        <tr class="bg-blue-50/50 border-y border-slate-200 baris-grup" data-nama="{{ strtolower($namaJamaah) }}">
                            <td colspan="6" class="px-6 py-3 font-bold text-slate-800">
                                <i class="fa-solid fa-user-circle text-blue-600 mr-2 text-lg align-middle"></i> 
                                <span class="align-middle text-base uppercase tracking-wide">Akun: {{ $namaJamaah }}</span>
                                <span class="ml-3 bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-[11px] align-middle border border-blue-200 shadow-sm">
                                    {{ $grupRsv->count() }} Transaksi
                                </span>
                            </td>
                        </tr>

                        {{-- LOOPING DETAIL TRANSAKSI SI JAMAAH --}}
                        @foreach($grupRsv as $rsv)
                        <tr class="hover:bg-slate-50 transition baris-detail" data-nama="{{ strtolower($namaJamaah) }}">
                            
                            {{-- Kolom Tanggal --}}
                            <td class="px-6 py-4 text-slate-700 font-medium whitespace-nowrap pl-10">
                                <i class="fa-regular fa-calendar text-slate-400 mr-2"></i>
                                {{ \Carbon\Carbon::parse($rsv->created_at)->translatedFormat('d F Y') }}
                            </td>
                            
                            {{-- Kolom No Reservasi Unik --}}
                            <td class="px-4 py-4 whitespace-nowrap">
                                @php
                                    $pkt = strtolower($rsv->paket);
                                    $kode = 'S';
                                    if (str_contains($pkt, 'wedding')) $kode = 'W';
                                    elseif (str_contains($pkt, 'akad')) $kode = 'A';
                                @endphp
                                <span class="text-slate-800 font-mono font-bold tracking-wider">
                                    {{ $rsv->user_id }}-RSV{{ $kode }}-{{ $rsv->id }}
                                </span>
                            </td>

                            {{-- Kolom Nama Pemohon Asli --}}
                            <td class="px-4 py-4 text-slate-700 font-bold whitespace-nowrap">
                                {{ $rsv->nama_pemohon ?? '-' }}
                            </td>

                            {{-- Kolom Tombol Animasi Pop-Up (Modal js sudah ada di file induk) --}}
                            <td class="px-4 py-4 text-center">
                                <button 
                                    data-rsv="{{ json_encode($rsv) }}"
                                    onclick="bukaModalReserver(this)"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-blue-700 transition shadow-sm mx-auto">
                                    Show Data Reserver
                                </button>
                            </td>

                            {{-- Kolom Keterangan --}}
                            <td class="px-4 py-4 text-slate-600 text-sm max-w-[200px] truncate">
                                @if($rsv->transaksis && $rsv->transaksis->count() > 0)
                                    {{ optional($rsv->transaksis->first())->keterangan ?? 'DP Reservasi '.$rsv->paket }}
                                @else
                                    DP Reservasi {{ $rsv->paket }}
                                @endif
                            </td>
                            
                            {{-- Kolom Nominal (Pakai optional mencegah error) --}}
                            <td class="px-6 py-4 font-bold text-slate-800 text-right whitespace-nowrap">
                                Rp {{ number_format(optional($rsv->transaksis->first())->nominal ?? $rsv->nominal_dp, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach

                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-400 text-sm">
                                <i class="fa-solid fa-inbox text-2xl mb-2 block"></i> Belum ada data reserver.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>