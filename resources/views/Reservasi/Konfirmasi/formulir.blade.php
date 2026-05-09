<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Reservasi - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">
     @php
        $paket = request('paket', 'Paket Belum Dipilih');
        $dp = 0;
        $harga_paket = 0; 
        $isAula = false;
        $bgImage = 'majlis.jpg';
        
        // PENANDA BARU UNTUK SOCIAL EVENT
        $isSocialEvent = false; 

        if (stripos($paket, 'Intimate Wedding') !== false) {
            $harga_paket = 2500000;
            $dp = 1000000; 
            $isAula = true;
            $bgImage = 'wedint.jpg';
        } elseif (stripos($paket, 'Wedding') !== false) {
            $harga_paket = 12500000;
            $dp = 3000000;
            $isAula = true;
            $bgImage = 'wedhall3.jpg';
        } elseif (stripos($paket, 'Akad') !== false) {
            $harga_paket = 3000000;
            $dp = 1000000;
            $bgImage = 'akad.jpg';
        } elseif (stripos($paket, 'Workshop') !== false) {
            $harga_paket = 7500000;
            $dp = 2000000;
            $isAula = true; 
            $bgImage = 'work.jpg'; 
            $isSocialEvent = true; // Tandai sebagai Social Event
        } elseif (stripos($paket, 'Wisuda') !== false) {
            $harga_paket = 7500000;
            $dp = 2000000;
            $isAula = true;
            $bgImage = 'wisuda.jpg'; 
            $isSocialEvent = true; // Tandai sebagai Social Event
        } elseif (stripos($paket, 'Majelis') !== false) {
            $harga_paket = 7500000;
            $dp = 2000000;
            $isAula = true;
            $bgImage = 'majlis.jpg'; 
            $isSocialEvent = true; // Tandai sebagai Social Event
        } 
    @endphp

    <img src="{{ asset('images/reservasi/' . $bgImage) }}" alt="Background" class="fixed inset-0 w-full h-full object-cover opacity-30 -z-10">

    <div class="max-w-6xl mx-auto px-4 py-12">
        
        <div class="flex items-center justify-center gap-2 md:gap-6 mb-12 overflow-x-auto pb-4">
            
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-check text-sm"></i>
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800">Penjadwalan</p>
                </div>
            </div>

            <div class="w-6 md:w-12 h-0.5 bg-blue-600"></div>

            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-check text-sm"></i>
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800">Login</p>
                </div>
            </div>

            <div class="w-6 md:w-12 h-0.5 bg-blue-600"></div>

            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 border border-blue-200 font-bold flex items-center justify-center text-lg shadow-sm">
                    3
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800">Formulir Data Reserver</p>
                </div>
            </div>

            <div class="w-6 md:w-12 h-0.5 bg-slate-200"></div>

            <div class="flex items-center gap-3 opacity-50">
                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-400 font-bold flex items-center justify-center text-lg">
                    4
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800">Pembayaran</p>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-8 bg-white rounded-[2rem] shadow-sm border border-slate-200 p-8 md:p-10">
                
                <form action="{{ route('reservasi.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="paket" value="{{ $paket }}">
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                    <input type="hidden" name="sesi" value="{{ $sesi }}">

                    <div class="mb-10">
                        <h2 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-2">1. Data Pemohon</h2>
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <label class="text-sm font-semibold text-slate-700">Nama Pemohon <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_pemohon" required placeholder="Nama Pemohon" class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <label class="text-sm font-semibold text-slate-700">Alamat <span class="text-red-500">*</span></label>
                                <input type="text" name="alamat_pemohon" required placeholder="Alamat" class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <label class="text-sm font-semibold text-slate-700">Telp / HP <span class="text-red-500">*</span></label>
                                <input type="tel" name="telp_pemohon" required placeholder="Telp / HP" class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start pt-2">
                                <label class="text-sm font-semibold text-slate-700 mt-2">Memo / Catatan Tambahan</label>
                                <textarea name="memo_pemohon" placeholder="Tuliskan catatan khusus atau permintaan tambahan di sini..." class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    @if(!$isSocialEvent)
                        
                        <div class="mb-10">
                            <h2 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-2">2. Data Calon Mempelai</h2>
                            
                            <h3 class="text-md font-bold text-slate-800 mb-4 pl-4 border-l-4 border-blue-500">A. Calon Pengantin Pria (CPP)</h3>
                            <div class="space-y-4 mb-8">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Nama (CPP) <span class="text-red-500">*</span></label>
                                    <div class="md:col-span-2 grid grid-cols-2 gap-4">
                                        <input type="text" name="nama_cpp" required placeholder="Nama (CPP)" class="w-full p-3 border border-slate-300 rounded-lg outline-none">
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-semibold">Bin <span class="text-red-500">*</span></span>
                                            <input type="text" name="bin_cpp" required placeholder="Bin" class="w-full p-3 border border-slate-300 rounded-lg outline-none">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Alamat <span class="text-red-500">*</span></label>
                                    <input type="text" name="alamat_cpp" required placeholder="Alamat" class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg outline-none">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Telp / HP <span class="text-red-500">*</span></label>
                                    <input type="tel" name="telp_cpp" required placeholder="Telp / HP" class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg outline-none">
                                </div>
                            </div>

                            <h3 class="text-md font-bold text-slate-800 mb-4 pl-4 border-l-4 border-pink-500">B. Calon Pengantin Wanita (CPW)</h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Nama (CPW) <span class="text-red-500">*</span></label>
                                    <div class="md:col-span-2 grid grid-cols-2 gap-4">
                                        <input type="text" name="nama_cpw" required placeholder="Nama (CPW)" class="w-full p-3 border border-slate-300 rounded-lg outline-none">
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-semibold">Binti <span class="text-red-500">*</span></span>
                                            <input type="text" name="binti_cpw" required placeholder="Binti" class="w-full p-3 border border-slate-300 rounded-lg outline-none">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Alamat <span class="text-red-500">*</span></label>
                                    <input type="text" name="alamat_cpw" required placeholder="Alamat" class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg outline-none">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Telp / HP <span class="text-red-500">*</span></label>
                                    <input type="tel" name="telp_cpw" required placeholder="Telp / HP" class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h2 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-2">3. Data Wali</h2>
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Nama Wali (CPW) <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_wali" required placeholder="Nama Wali (CPW)" class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg outline-none">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Alamat <span class="text-red-500">*</span></label>
                                    <input type="text" name="alamat_wali" required placeholder="Alamat" class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg outline-none">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Telp / HP <span class="text-red-500">*</span></label>
                                    <input type="tel" name="telp_wali" required placeholder="Telp / HP" class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg outline-none">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center mt-6">
                                    <label class="text-sm font-semibold text-slate-700">KUA dari Kecamatan <span class="text-red-500">*</span></label>
                                    <input type="text" name="kua_kecamatan" required placeholder="KUA dari Kecamatan" class="md:col-span-2 w-full p-3 border border-slate-300 rounded-lg outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h2 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-2">Upload Dokumen</h2>
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Surat Rekomendasi dari KUA</label>
                                    <input type="file" name="surat_rekomendasi" class="md:col-span-2 w-full p-2 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Foto KTP Pria (CPP)</label>
                                    <input type="file" name="foto_ktp_cpp" accept="image/*" class="md:col-span-2 w-full p-2 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Foto KTP Wanita (CPW)</label>
                                    <input type="file" name="foto_ktp_cpw" accept="image/*" class="md:col-span-2 w-full p-2 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Foto Pria (CPP) 3x4</label>
                                    <input type="file" name="foto_cpp_3x4" accept="image/*" class="md:col-span-2 w-full p-2 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <label class="text-sm font-semibold text-slate-700">Foto Wanita (CPW) 3x4</label>
                                    <input type="file" name="foto_cpw_3x4" accept="image/*" class="md:col-span-2 w-full p-2 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                                </div>
                            </div>
                        </div>

                    @endif

                    <div class="flex justify-between items-center pt-6 border-t border-slate-200">
                        <a href="{{ route('reservasi.tgl', ['paket' => $paket]) }}" class="flex items-center gap-2 text-slate-400 font-bold hover:text-slate-600 transition">
                            <i class="fa-solid fa-chevron-left text-2xl"></i> Back
                        </a>
                        <button type="submit" class="text-blue-500 font-bold hover:text-blue-700 transition">
                            Continue <i class="fa-solid fa-chevron-right ml-1"></i>
                        </button>
                    </div>

                </form>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-200 sticky top-10">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Informasi Reservasi</h3>
                    
                    <div class="space-y-4 text-sm mb-8">
                        <div class="grid grid-cols-3 gap-2">
                            <span class="text-slate-800 font-semibold">Acara</span>
                            <span class="col-span-2 text-slate-600">: {{ $paket }}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <span class="text-slate-800 font-semibold">Tanggal</span>
                            <span class="col-span-2 text-slate-600">: {{ $tanggal }}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <span class="text-slate-800 font-semibold">Jam</span>
                            <span class="col-span-2 text-slate-600">: {{ $sesi }}</span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <span class="text-slate-800 font-semibold block mb-1">Biaya :</span>
                            {{-- Memastikan pakai variabel yang benar dari Controller/Blade sebelumnya --}}
                            <div class="text-2xl text-slate-900">Rp {{ number_format($harga_paket ?? $harga, 0, ',', '.') }}</div>
                        </div>
                        <div>
                            <span class="text-slate-800 font-semibold block mb-1">DP :</span>
                            <div class="text-2xl text-slate-900">Rp {{ number_format($dp, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>