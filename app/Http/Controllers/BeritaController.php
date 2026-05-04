<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\File; // Wajib ditambahkan untuk fitur hapus foto fisik

class BeritaController extends Controller
{
    // 1. Menampilkan Halaman Berita
    public function index()
    {
        // Ambil semua berita dari database, urutkan dari yang paling baru
        $beritas = Berita::orderBy('created_at', 'desc')->get();
        return view('admin.berita', compact('beritas'));
    }

    // 2. Menyimpan Berita Baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'isi_konten' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        $nama_foto = null;

        // Proses Upload Foto jika admin memilih file
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_foto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/berita'), $nama_foto);
        }

        // Simpan ke Database
        Berita::create([
            'kategori' => $request->kategori,
            'sub_kategori' => $request->sub_kategori,
            'judul' => $request->judul,
            'isi_konten' => $request->isi_konten,
            'foto' => $nama_foto,
        ]);

        return back()->with('success', 'Publikasi berhasil ditambahkan!');
    }

    // 3. Menghapus Berita (Mass Delete via Checkbox)
    public function destroy(Request $request)
    {
        // Menangkap array ID dari checkbox yang dicentang
        $ids = $request->ids; 

        if ($ids) {
            $beritas = Berita::whereIn('id', $ids)->get();

            foreach ($beritas as $berita) {
                // Hapus file foto dari folder public/images/berita jika fotonya ada
                if ($berita->foto && File::exists(public_path('images/berita/' . $berita->foto))) {
                    File::delete(public_path('images/berita/' . $berita->foto));
                }
                // Hapus data dari database
                $berita->delete();
            }

            return back()->with('success', count($ids) . ' publikasi berhasil dihapus!');
        }

        return back()->with('error', 'Tidak ada data yang dipilih.');
    }

    // 4. Menyimpan Perubahan (Update Berita)
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'isi_konten' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $berita = Berita::findOrFail($id);

        // Jika admin mengupload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari folder (jika ada)
            if ($berita->foto && File::exists(public_path('images/berita/' . $berita->foto))) {
                File::delete(public_path('images/berita/' . $berita->foto));
            }
            
            // Simpan foto baru
            $file = $request->file('foto');
            $nama_foto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/berita'), $nama_foto);
            
            // Masukkan nama foto baru ke database
            $berita->foto = $nama_foto;
        }

        // Update data lainnya
        $berita->update([
            'kategori' => $request->kategori,
            'sub_kategori' => $request->sub_kategori,
            'judul' => $request->judul,
            'isi_konten' => $request->isi_konten,
            // (Catatan: foto tidak perlu dimasukkan ke sini karena sudah diurus di atas)
        ]);

        return back()->with('success', 'Publikasi berhasil diperbarui!');
    }

    public function home()
    {
        // Ambil semua berita, urutkan yang terbaru di atas
        $news = Berita::orderBy('created_at', 'desc')->get();

        // Arahkan ke file home.blade.php sambil membawa data $news
        return view('home', compact('news'));
    }

    // Fungsi untuk menampilkan halaman 1 berita secara detail
    public function show($id)
    {
        // Cari berita berdasarkan ID yang diklik
        $berita = Berita::findOrFail($id);
        
        // Ambil 5 berita terbaru untuk ditampilkan di Sidebar sebelah kanan
        $beritaTerbaru = Berita::orderBy('created_at', 'desc')->take(5)->get();

        // Lempar data ke halaman berita_detail.blade.php
        return view('berita', compact('berita', 'beritaTerbaru'));
    }

    public function portal()
    {
        // 1. Ambil 6 berita paling baru (semua kategori) untuk Headline
        $semuaBerita = Berita::orderBy('created_at', 'desc')->take(6)->get();

        // 2. Ambil khusus kategori Kajian
        $kajian = Berita::where('sub_kategori', 'kajian_kitab')
                        ->orWhere('sub_kategori', 'kajian_rutin')
                        ->orderBy('created_at', 'desc')->take(4)->get();

        // 3. Ambil khusus kategori Agenda
        $agenda = Berita::where('sub_kategori', 'agenda')
                        ->orderBy('created_at', 'desc')->take(4)->get();

        // 4. Ambil khusus kategori Pendidikan
        $pendidikan = Berita::where('sub_kategori', 'pendidikan')
                            ->orderBy('created_at', 'desc')->take(4)->get();

        return view('kegiatan.semuaberita', compact('semuaBerita', 'kajian', 'agenda', 'pendidikan'));
    }
    public function kajian()
    {
        $kajianKitab = Berita::where('sub_kategori', 'kajian_kitab')
                            ->orderBy('created_at', 'desc')
                            ->get();

        $kajianRutin = Berita::where('sub_kategori', 'kajian_rutin')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('kegiatan.kajian', compact('kajianKitab', 'kajianRutin'));
    }
    public function agenda()
    {
        $heroAgenda = Berita::where('sub_kategori', 'agenda')
                            ->orderBy('created_at', 'desc')
                            ->take(5) // Maksimal 5 slide di hero
                            ->get();

        $agendaPosters = Berita::where('sub_kategori', 'agenda')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('kegiatan.agenda', compact('heroAgenda', 'agendaPosters'));
    }

    public function agendaShow($id)
    {
        $agenda = Berita::findOrFail($id);

        $agendaTerbaru = Berita::where('sub_kategori', 'agenda')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        return view('kegiatan.agenda_detail', compact('agenda', 'agendaTerbaru'));
    }
    public function pendidikan()
    {
        $pendidikanPosters = Berita::where('sub_kategori', 'pendidikan')
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('kegiatan.pendidikan', compact('pendidikanPosters'));
    }

    public function pendidikanShow($id)
    {
        $pendidikan = Berita::findOrFail($id);

        $pendidikanTerbaru = Berita::where('sub_kategori', 'pendidikan')
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

        return view('kegiatan.pendidikan_detail', compact('pendidikan', 'pendidikanTerbaru'));
    }
}