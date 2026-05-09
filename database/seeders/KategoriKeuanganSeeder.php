<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriKeuangan;

class KategoriKeuanganSeeder extends Seeder
{
    public function run(): void
    {
    
        $data = [
            ['nama' => 'Pelunasan Reservasi Wedding',               'jenis' => 'pemasukan'],
            ['nama' => 'Pelunasan Reservasi Sosial Event ',         'jenis' => 'pemasukan'],
            ['nama' => 'Pelunasan Reservasi Akad ',                 'jenis' => 'pemasukan'],
            ['nama' => 'Infaq Online',                              'jenis' => 'pemasukan'],
            ['nama' => 'Zakat Online',                              'jenis' => 'pemasukan'],
            ['nama' => 'Infaq Offline',                             'jenis' => 'pemasukan'],
            ['nama' => 'Zakat Offline',                             'jenis' => 'pemasukan'],
            ['nama' => 'Pengeluaran Operasional',                   'jenis' => 'pengeluaran'],
            ['nama' => 'Pengeluaran Lainnya',                       'jenis' => 'pengeluaran'],
        ];

        $namaList = array_column($data, 'nama');

        // Tambah yang belum ada
    foreach ($data as $item) {
        KategoriKeuangan::firstOrCreate(['nama' => $item['nama']], $item);
    }

    // Update jenis yang mungkin salah
    foreach ($data as $item) {
        KategoriKeuangan::where('nama', $item['nama'])->update(['jenis' => $item['jenis']]);
    }
        }
}