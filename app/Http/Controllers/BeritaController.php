<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->get();
        return view('admin.berita', compact('beritas'));
    }

    // --------------------------------------------------------
    // TAMBAH BERITA
    // --------------------------------------------------------

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'isi_konten' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $nama_foto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_foto = time() . '_' . $file->getClientOriginalName();
            
            $tujuan_upload = $_SERVER['DOCUMENT_ROOT'] . '/images/berita';
            $file->move($tujuan_upload, $nama_foto);
            
        }

        Berita::create([
            'kategori' => $request->kategori,
            'sub_kategori' => $request->sub_kategori,
            'judul' => $request->judul,
            'isi_konten' => $request->isi_konten,
            'foto' => $nama_foto,
        ]);

        return back()->with('success', 'Publikasi berhasil ditambahkan!');
    }

    // --------------------------------------------------------
    // HAPUS BERITA
    // --------------------------------------------------------
    public function destroy(Request $request)
    {
        $ids = $request->ids; 

        if ($ids) {
            $beritas = Berita::whereIn('id', $ids)->get();
    
            foreach ($beritas as $berita) {
                if ($berita->foto) {
                    @unlink($_SERVER['DOCUMENT_ROOT'] . '/images/berita/' . $berita->foto);
                    @unlink(public_path('images/berita/' . $berita->foto));
                }
                
                $berita->delete();
            }
    
            return back()->with('success', count($ids) . ' publikasi berhasil dihapus!');
        }
        return back()->with('error', 'Tidak ada data yang dipilih.');
    }

    // --------------------------------------------------------
    // EDIT BERITA
    // --------------------------------------------------------
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'isi_konten' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('foto')) {
            $tujuan_upload = $_SERVER['DOCUMENT_ROOT'] . '/images/berita';
            
            if ($berita->foto && file_exists($tujuan_upload . '/' . $berita->foto)) {
                unlink($tujuan_upload . '/' . $berita->foto);
            }
            
            $file = $request->file('foto');
            $nama_foto = time() . '_' . $file->getClientOriginalName();
            $file->move($tujuan_upload, $nama_foto);
            
            $berita->foto = $nama_foto;
        }

        $berita->update([
            'kategori' => $request->kategori,
            'sub_kategori' => $request->sub_kategori,
            'judul' => $request->judul,
            'isi_konten' => $request->isi_konten,
        ]);

        return back()->with('success', 'Publikasi berhasil diperbarui!');
    }

    // --------------------------------------------------------
    // FUGNSI TAMPILKAN
    // --------------------------------------------------------
    public function home()
    {
        $news = Berita::orderBy('created_at', 'desc')->get();

        return view('home', compact('news'));
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        
        $beritaTerbaru = Berita::orderBy('created_at', 'desc')->take(5)->get();

        return view('berita', compact('berita', 'beritaTerbaru'));
    }

    public function portal()
    {
        $semuaBerita = Berita::orderBy('created_at', 'desc')->take(6)->get();

        $kajian = Berita::where('sub_kategori', 'kajian_kitab')
                        ->orWhere('sub_kategori', 'kajian_rutin')
                        ->orderBy('created_at', 'desc')->take(4)->get();

        $agenda = Berita::where('sub_kategori', 'agenda')
                        ->orderBy('created_at', 'desc')->take(4)->get();

        $pendidikan = Berita::where('sub_kategori', 'pendidikan')
                            ->orderBy('created_at', 'desc')->take(4)->get();

        return view('kegiatan.semuaBerita', compact('semuaBerita', 'kajian', 'agenda', 'pendidikan'));
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
                            ->take(5)
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
        $kegiatan = Berita::findOrFail($id);

        $pendidikanTerbaru = Berita::where('sub_kategori', 'pendidikan')
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

        return view('Kegiatan.detail', compact('kegiatan', 'pendidikanTerbaru'));
    }
    
    // --------------------------------------------------------
    // UPDATE STRUKTUR ORGANISASI
    // --------------------------------------------------------
    public function updateStruktur(Request $request)
    {
        $request->validate([
            'struktur_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('struktur_image')) {
            $file = $request->file('struktur_image');
            
            $nama_file = 'struktur.jpeg';
            
            $file->move($_SERVER['DOCUMENT_ROOT'] . '/images', $nama_file);

            return back()->with('success', 'Foto struktur organisasi berhasil diperbarui!');
        }

        return back()->with('error', 'Gagal mengupload foto struktur.');
    }
}