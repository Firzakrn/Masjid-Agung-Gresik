<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukasi Infaq & Sedekah | Masjid Agung Gresik</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-arab { font-family: 'Amiri', serif; line-height: 2.2; }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen overflow-x-hidden" x-data="zisApp()" :class="isZisModalOpen ? 'overflow-hidden' : ''">

    @include('navbar')

    <!-- ================= 1. HERO SECTION (GAMBAR 1) ================= -->
    <section class="relative w-full h-[60vh] min-h-[450px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <!-- Gambar 1: Suasana damai/masjid -->
            <img src="https://images.unsplash.com/photo-1519817650390-64a93db51149?q=80&w=2000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Suasana Damai">
            <div class="absolute inset-0 bg-emerald-900/85 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-50 to-transparent"></div>
        </div>
        
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-16 md:mt-0">
            <span class="inline-block py-1 px-3 rounded-full bg-emerald-500/20 border border-emerald-400/50 text-emerald-100 font-bold text-sm tracking-widest uppercase mb-4 backdrop-blur-sm">
                Fiqih & Keutamaan Berbagi
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 drop-shadow-lg leading-tight">Keutamaan <br><span class="text-emerald-400">Infaq & Sedekah</span></h1>
            <p class="text-lg md:text-xl text-emerald-50 max-w-2xl mx-auto leading-relaxed drop-shadow mb-2">
                Pahami luasnya makna berbagi dalam Islam. Tidak hanya dengan harta, tapi juga dengan kebaikan yang membawa keberkahan di dunia dan akhirat.
            </p>
            <button @click="openModal()" class="mx-auto bg-green-600 opacity-75 hover:bg-green-500 text-white font-extrabold text-lg py-2 px-5 rounded-full hover:shadow-green-400/50 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-3 border-2 border-green-300">
                Tunaikan Sekarang
            </button>
        </div>
    </section>

    <!-- ================= MAIN CONTENT ================= -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-12 md:py-20 -mt-10 relative z-20 space-y-16">

        <section class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 items-stretch">
            
            <!-- KOLOM TEKS INFAQ & SEDEKAH -->
            <div class="md:col-span-7 flex flex-col gap-8">
                
                <!-- BLOK INFAQ -->
                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                    <h2 class="text-3xl font-extrabold text-emerald-800 mb-6 flex items-center gap-3 border-b border-emerald-100 pb-4">
                        <i class="fa-solid fa-hand-holding-dollar text-emerald-500"></i> Memahami Infaq
                    </h2>
                    
                    <p class="text-slate-600 leading-relaxed mb-6 font-medium">
                        <strong class="text-emerald-700">Infaq</strong> artinya mengeluarkan sebagian harta untuk kepentingan yang diperintahkan oleh Islam. Infaq tak mengenal nishab, dikeluarkan oleh setiap orang yang beriman baik dalam keadaan lapang maupun sempit, dan boleh diberikan kepada siapapun (kedua orang tua, anak yatim, dan sebagainya).
                    </p>

                    <div class="bg-emerald-50 p-6 md:p-8 rounded-3xl border border-emerald-100 relative mt-8">
                        <i class="fa-solid fa-quote-right absolute top-6 right-6 text-4xl text-emerald-200/50"></i>
                        <p class="font-arab text-2xl md:text-[28px] leading-relaxed text-right text-emerald-900 mb-4" dir="rtl">
                            إِنَّ الَّذِينَ يَتْلُونَ كِتَابَ اللَّهِ وَأَقَامُوا الصَّلَاةَ وَأَنْفَقُوا مِمَّا رَزَقْنَاهُمْ سِرًّا وَعَلَانِيَةً يَرْجُونَ تِجَارَةً لَنْ تَبُورَ
                        </p>
                        <p class="text-slate-700 font-medium italic mb-2">
                            “Sesungguhnya orang-orang yang selalu membaca kitab Allah (Al-Quran) dan melaksanakan shalat dan menginfakkan sebagian rejeki yang kami anugerahkan kepadanya dengan diam-diam dan terang-terangan, mereka mengharapkan perdagangan yang tidak akan merugi”
                        </p>
                        <p class="text-sm text-emerald-600 font-bold">— (QS Fathir: 29)</p>
                    </div>
                </div>

                <!-- BLOK SEDEKAH -->
                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                    <h2 class="text-3xl font-extrabold text-blue-800 mb-6 flex items-center gap-3 border-b border-blue-100 pb-4">
                        <i class="fa-solid fa-seedling text-blue-500"></i> Memahami Sedekah
                    </h2>
                    
                    <p class="text-slate-600 leading-relaxed mb-6 font-medium">
                        <strong class="text-blue-700">Sedekah</strong> memiliki arti yang lebih luas dari infaq, namun sama dalam ketentuan dan hukumnya. Sedekah tidak hanya menyangkut hal uang, namun juga hal yang bersifat non-materiil untuk kebaikan sosial dan mendekatkan diri kepada Allah.
                    </p>

                    <div class="bg-blue-50/50 p-6 rounded-2xl border-l-4 border-blue-500">
                        <p class="text-slate-700 font-medium italic mb-3">
                            "Rasulullah menyatakan bahwa jika tak mampu bersedekah dengan harta, maka membaca tasbih, takbir, tahmid, tahlil, dan melakukan amar ma'ruf nahi munkar adalah sedekah."
                        </p>
                        <p class="text-sm text-blue-600 font-bold">— (Hadist Imam Muslim dari Abu Dzar)</p>
                    </div>
                </div>

            </div>

            <!-- GAMBAR 2 (Samping) -->
            <div class="md:col-span-5 h-full min-h-[400px]">
                <div class="rounded-[2.5rem] overflow-hidden shadow-xl shadow-slate-200/50 h-full relative group sticky top-24">
                    <!-- Gambar 2: Ilustrasi Memberi/Bersedekah -->
                    <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="Memberi Sedekah">
                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/80 via-emerald-900/20 to-transparent"></div>
                    
                    <!-- Dekorasi Teks di atas Gambar -->
                    <div class="absolute bottom-0 left-0 p-8 w-full">
                        <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20">
                            <h3 class="text-white font-bold text-xl mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-infinity text-yellow-400"></i> Tanpa Batas
                            </h3>
                            <p class="text-slate-200 text-sm">
                                Berbeda dengan Zakat yang memiliki nisab dan waktu tertentu, Infaq dan Sedekah dapat ditunaikan kapan saja dan berapapun jumlahnya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- ================= KESIMPULAN & CTA BAWAH (GAMBAR 3) ================= -->
        <section class="relative rounded-[3rem] overflow-hidden shadow-2xl mt-10">
            <!-- Gambar 3: CTA Background -->
            <img src="https://images.unsplash.com/photo-1585036156171-384164a8c675?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover" alt="Interior Masjid">
            <div class="absolute inset-0 bg-emerald-900/90 mix-blend-multiply"></div>
            
            <div class="relative z-10 p-8 md:p-16 flex flex-col md:flex-row items-center justify-between gap-10">
                <div class="w-full md:w-3/5 text-white">
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-4 leading-tight">Perdagangan Yang <br><span class="text-emerald-400">Tidak Akan Merugi</span></h2>
                    <p class="text-slate-300 text-lg mb-6">
                        Setiap kebaikan yang kita keluarkan di jalan Allah, sekecil apapun itu, akan diganti dengan ganjaran yang berlipat ganda.
                    </p>
                </div>
                
                <div class="w-full md:w-2/5 bg-white p-8 rounded-3xl text-center shadow-xl transform hover:scale-105 transition duration-300">
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Salurkan Kebaikan</h3>
                    <p class="text-sm text-slate-500 mb-6">Mari tunaikan Infaq & Sedekah Anda melalui Masjid Agung Gresik untuk kemakmuran umat.</p>
                    
                    <!-- Tombol Pemicu Modal -->
                    <button @click="openModal()" class="block w-full py-4 px-6 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition shadow-lg shadow-emerald-200 text-center flex items-center justify-center gap-2">
                        <i class="fa-solid fa-hand-holding-dollar"></i> Mulai Berbagi
                    </button>
                    <p class="text-xs text-slate-400 mt-4"><i class="fa-solid fa-shield-halal mr-1"></i> Penyaluran Transparan & Amanah</p>
                </div>
            </div>
        </section>

    </main>

    <!-- MANGGIL FILE MODAL ZIS -->
    @include('Infaq.infaq')

    @include('footer')

    <!-- SCRIPT ALPINE.JS -->
    <script>
        function zisApp() {
            return {
                isZisModalOpen: false,
                nominal: '',
                openModal() {
                    this.isZisModalOpen = true;
                },
                closeModal() {
                    this.isZisModalOpen = false;
                    this.nominal = ''; 
                },
                setNominal(jumlah) {
                    this.nominal = jumlah;
                }
            }
        }
    </script>
</body>
</html>