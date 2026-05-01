<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi; 
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap; // library Midtrans

class ReservasiController extends Controller
{
    public function tanggalSesi(Request $request)
    {
        $paket = $request->query('paket', 'Paket Belum Dipilih');
        
        // Baca: folder views -> reservasi -> konfirmasi -> tgl-sesi.blade.php
        return view('reservasi.konfirmasi.tgl-sesi', compact('paket'));
    }

    public function formReservasi(Request $request)
    {
        $paket = $request->query('paket', 'Paket Belum Dipilih');
        $tanggal = $request->query('tanggal', '-');
        $sesi = $request->query('sesi', '-');

        $harga = 12500000; 
        $dp = 3000000;     

        // Baca: folder views -> reservasi -> konfirmasi -> form_reservasi.blade.php
        return view('reservasi.konfirmasi.formulir', compact('paket', 'tanggal', 'sesi', 'harga', 'dp'));
    }


    // Menampilkan halaman pembayaran & fasilitas
    public function pembayaran($id)
    {
        $reservasi = \App\Models\Reservasi::findOrFail($id);
        
        // Tentukan harga dasar sesuai paket yang tersimpan
        $harga = 0; $dp = 0;
        if (stripos($reservasi->paket, 'Intimate Wedding') !== false) {
            $harga = 2500000; $dp = 1000000;
        } elseif (stripos($reservasi->paket, 'Wedding') !== false) {
            $harga = 12500000; $dp = 3000000;
        } elseif (stripos($reservasi->paket, 'Akad') !== false) {
            $harga = 3000000; $dp = 1000000;
        } else {
            $harga = 7500000; $dp = 2000000; // Untuk Workshop, Wisuda, Majelis, dsb.
        }

        return view('reservasi.konfirmasi.pembayaran', compact('reservasi', 'harga', 'dp'));
    }

    public function submit(Request $request)
    {
        // 1. Validasi Input Dasar
        // Ini untuk memastikan data wajib tidak boleh kosong
        $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'telp_pemohon' => 'required|string|max:20',
            // File gambar dibatasi maksimal 2MB agar server tidak penuh
            'foto_ktp_cpp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_ktp_cpw' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Logika Upload File & Gambar
        // Jika ada file yang diunggah, simpan ke folder storage/app/public/dokumen_reservasi
        $surat = $request->hasFile('surat_rekomendasi') ? $request->file('surat_rekomendasi')->store('dokumen_reservasi', 'public') : null;
        $ktp_cpp = $request->hasFile('foto_ktp_cpp') ? $request->file('foto_ktp_cpp')->store('dokumen_reservasi', 'public') : null;
        $ktp_cpw = $request->hasFile('foto_ktp_cpw') ? $request->file('foto_ktp_cpw')->store('dokumen_reservasi', 'public') : null;
        $foto_cpp = $request->hasFile('foto_cpp_3x4') ? $request->file('foto_cpp_3x4')->store('dokumen_reservasi', 'public') : null;
        $foto_cpw = $request->hasFile('foto_cpw_3x4') ? $request->file('foto_cpw_3x4')->store('dokumen_reservasi', 'public') : null;

        // 3. Simpan Seluruh Data ke Database menggunakan Model Eloquent
        $reservasi = Reservasi::create([
            'user_id' => Auth::id(), // Kunci rahasia: Mengambil ID jamaah yang sedang login
            'paket' => $request->paket,
            'tanggal' => $request->tanggal,
            'sesi' => $request->sesi,
            'status' => 'Menunggu Pembayaran DP',
            
            // Data Pemohon
            'nama_pemohon' => $request->nama_pemohon,
            'alamat_pemohon' => $request->alamat_pemohon,
            'telp_pemohon' => $request->telp_pemohon,
            
            // Data CPP (Pengantin Pria)
            'nama_cpp' => $request->nama_cpp,
            'bin_cpp' => $request->bin_cpp,
            'alamat_cpp' => $request->alamat_cpp,
            'telp_cpp' => $request->telp_cpp,
            
            // Data CPW (Pengantin Wanita)
            'nama_cpw' => $request->nama_cpw,
            'binti_cpw' => $request->binti_cpw,
            'alamat_cpw' => $request->alamat_cpw,
            'telp_cpw' => $request->telp_cpw,
            
            // Data Wali
            'nama_wali' => $request->nama_wali,
            'alamat_wali' => $request->alamat_wali,
            'telp_wali' => $request->telp_wali,
            'kua_kecamatan' => $request->kua_kecamatan,
            
            // Link Dokumen yang sudah diupload
            'surat_rekomendasi' => $surat,
            'foto_ktp_cpp' => $ktp_cpp,
            'foto_ktp_cpw' => $ktp_cpw,
            'foto_cpp_3x4' => $foto_cpp,
            'foto_cpw_3x4' => $foto_cpw,
        ]);

        // 4. Setelah berhasil tersimpan, arahkan jamaah ke halaman Struk/Pembayaran
        // Kita bawa 'id' reservasinya agar halaman pembayaran tahu harus menampilkan tagihan yang mana
        return redirect()->route('reservasi.pembayaran', ['id' => $reservasi->id]);
    }

    public function selesai(Request $request, $id)
    {
        return redirect('/')->with('welcome', 'Alhamdulillah, Reservasi berhasil! Silakan tunggu konfirmasi Admin.');
    }
}