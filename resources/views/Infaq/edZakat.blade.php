<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukasi Zakat | Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Font Arab & Font Utama -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-arab { font-family: 'Amiri', serif; line-height: 2.2; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen overflow-x-hidden" x-data="zisApp()" :class="isZisModalOpen ? 'overflow-hidden' : ''">

    @include('navbar')

    <!-- ================= 1. HERO SECTION (FOTO 1) ================= -->
    <section class="relative w-full h-[60vh] min-h-[400px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?q=80&w=2000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Masjid Interior">
            <div class="absolute inset-0 bg-emerald-900/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-50 to-transparent"></div>
        </div>
        
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-16 md:mt-0 items-center">
            <span class="inline-block py-1 px-3 rounded-full bg-emerald-500/20 border border-emerald-400/50 text-emerald-100 font-bold text-sm tracking-widest uppercase mb-4 backdrop-blur-sm">
                Fiqih & Edukasi Umat
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 drop-shadow-lg leading-tight">Panduan Lengkap <br><span class="text-emerald-400">Memahami Zakat</span></h1>
            <p class="text-lg md:text-xl text-emerald-50 max-w-2xl mx-auto leading-relaxed drop-shadow mb-10">
                Pelajari pengertian, hukum, hikmah, hingga penyaluran zakat sesuai syariat Islam untuk membersihkan harta dan menyucikan jiwa.
            </p>
            <button @click="openModal()" class="mx-auto bg-green-600 opacity-75 hover:bg-green-500 text-white font-extrabold text-lg py-2 px-5 rounded-full hover:shadow-green-400/50 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-3 border-2 border-green-300">
                Tunaikan Zakat Sekarang
            </button>
        </div>
    </section>

    <!-- ================= MAIN CONTENT ================= -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-12 md:py-20 -mt-20 relative z-20 space-y-20">

        <!-- 1 & 2: PENGERTIAN & DASAR HUKUM -->
        <section class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12">
            <!-- Teks -->
            <div class="md:col-span-7 bg-white p-8 md:p-12 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold text-emerald-800 mb-6 flex items-center gap-3">
                        <i class="fa-solid fa-book-quran text-emerald-500"></i> 1. Pengertian Zakat
                    </h2>
                    <ul class="space-y-4 text-slate-600 mb-6">
                        <li class="flex items-start gap-3"><i class="fa-solid fa-check text-emerald-500 mt-1"></i> <div><strong class="text-slate-800">Secara bahasa:</strong> Berarti berkembang (النماء), berkah (البركة), dan menyucikan (الطهارة).</div></li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-check text-emerald-500 mt-1"></i> <div><strong class="text-slate-800">Secara istilah fiqih:</strong> Sejumlah harta tertentu yang wajib dikeluarkan dari harta tertentu untuk diberikan kepada golongan tertentu (mustahiq).</div></li>
                    </ul>
                    
                    <div class="bg-emerald-50 p-6 rounded-2xl border-l-4 border-emerald-500 relative mt-8">
                        <i class="fa-solid fa-quote-right absolute top-4 right-4 text-4xl text-emerald-200"></i>
                        <p class="font-arab text-2xl md:text-3xl text-right text-emerald-900 mb-4" dir="rtl">وَسُمِّيَتْ بِذَلِكَ لِأَنَّ الْمَالَ يَنْمُو بِبَرَكَةِ إِخْرَاجِهَا وَدُعَاءِ الْآخِذِ</p>
                        <p class="text-slate-700 italic font-medium">"Disebut zakat karena harta akan berkembang dengan keberkahan dari mengeluarkannya dan doa dari penerimanya."</p>
                        <p class="text-sm text-emerald-600 font-bold mt-2">— Syekh Taqiyuddin Abu Bakar bin Muhammad al-Hishni, Kifayatul Akhyar</p>
                    </div>
                </div>

                <div>
                    <h2 class="text-3xl font-extrabold text-emerald-800 mb-6 flex items-center gap-3">
                        <i class="fa-solid fa-scale-balanced text-emerald-500"></i> 2. Dasar Hukum
                    </h2>
                    <div class="space-y-6">
                        <div class="p-5 border border-slate-200 rounded-2xl hover:border-emerald-300 transition shadow-sm">
                            <p class="font-arab text-2xl text-right text-slate-800 mb-2" dir="rtl">وَأَقِيمُوا الصَّلَاةَ وَآتُوا الزَّكَاةَ</p>
                            <p class="text-slate-600">"Dirikanlah shalat dan tunaikanlah zakat." <strong class="text-emerald-700">(QS. Al-Baqarah: 43)</strong></p>
                        </div>
                        <div class="p-5 border border-slate-200 rounded-2xl hover:border-emerald-300 transition shadow-sm">
                            <p class="font-arab text-xl text-right text-slate-800 mb-2" dir="rtl">وَمَا آتَيْتُمْ مِنْ زَكَاةٍ تُرِيدُونَ وَجْهَ اللَّهِ فَأُولَٰئِكَ هُمُ الْمُضْعِفُونَ</p>
                            <p class="text-slate-600">"Zakat yang kamu berikan untuk mencari ridha Allah, maka mereka itulah yang dilipatgandakan pahalanya." <strong class="text-emerald-700">(QS. Ar-Rum: 39)</strong></p>
                        </div>
                        <div class="p-5 border border-slate-200 rounded-2xl hover:border-emerald-300 transition shadow-sm bg-slate-50">
                            <p class="font-arab text-xl text-right text-slate-800 mb-2" dir="rtl">بُنِيَ الإِسْلاَمُ عَلَى خَمْسٍ... وَإِيتَاءِ الزَّكَاةِ</p>
                            <p class="text-slate-600">"Islam dibangun atas lima perkara… di antaranya menunaikan zakat." <strong class="text-emerald-700">(HR. Bukhari & Muslim)</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOTO 2: Al-Quran/Orang Berdoa -->
            <div class="md:col-span-5 flex flex-col gap-8">
                <div class="rounded-[2.5rem] overflow-hidden shadow-xl shadow-slate-200/50 h-64 md:h-full relative group">
                    <img src="https://images.unsplash.com/photo-1609599006353-e629aaab31ce?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="Al-Quran">
                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/60 to-transparent"></div>
                </div>
                
                <!-- 3. Sejarah Singkat -->
                <div class="bg-emerald-800 text-white p-8 rounded-[2rem] shadow-xl">
                    <h3 class="text-2xl font-bold mb-4 flex items-center gap-2"><i class="fa-solid fa-clock-rotate-left text-emerald-300"></i> 3. Sejarah Zakat</h3>
                    <ul class="space-y-4 text-emerald-100/90 text-sm">
                        <li class="flex items-start gap-2"><i class="fa-solid fa-caret-right mt-1 text-emerald-400"></i> <span>Terdapat perbedaan pendapat ulama (ada yang berpendapat sebelum hijrah).</span></li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-caret-right mt-1 text-emerald-400"></i> <span><strong>Pendapat Masyhur:</strong><br>- Zakat Mal: Tahun 2 H (Syawal)<br>- Zakat Fitrah: Menjelang Idul Fitri</span></li>
                        <li class="mt-4 pt-4 border-t border-emerald-700/50 text-xs italic text-emerald-200">Rujukan: Sulaiman al-Jamal, Hasyiyah al-Jamal ‘ala al-Minhaj, jilid 2, hlm. 96</li>
                    </ul>
                </div>
            </div>
        </section>


        <!-- 4 & 5: HIKMAH & JENIS ZAKAT -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
            <!-- 4. Hikmah -->
            <div class="order-2 md:order-1 flex flex-col justify-center">
                <h2 class="text-3xl font-extrabold text-emerald-800 mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-hand-holding-heart text-emerald-500"></i> 4. Hikmah Zakat
                </h2>
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-3"><i class="fa-solid fa-arrow-up-right-dots text-emerald-500 text-xl"></i> <span class="font-bold text-slate-700 text-sm">Mengentaskan kemiskinan</span></div>
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-3"><i class="fa-solid fa-users text-emerald-500 text-xl"></i> <span class="font-bold text-slate-700 text-sm">Kasih sayang sosial</span></div>
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-3"><i class="fa-solid fa-broom text-emerald-500 text-xl"></i> <span class="font-bold text-slate-700 text-sm">Membersihkan harta & jiwa</span></div>
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-3"><i class="fa-solid fa-scale-unbalanced text-emerald-500 text-xl"></i> <span class="font-bold text-slate-700 text-sm">Mengurangi kesenjangan</span></div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm mb-6">
                    <p class="font-arab text-2xl text-right text-emerald-900 mb-2" dir="rtl">خُذْ مِنْ أَمْوَالِهِمْ صَدَقَةً تُطَهِّرُهُمْ وَتُزَكِّيهِمْ بِهَا</p>
                    <p class="text-slate-600 text-sm">"Ambillah zakat dari harta mereka untuk membersihkan dan menyucikan mereka." <strong class="text-emerald-700">(QS. At-Taubah: 103)</strong></p>
                </div>
                
                <blockquote class="border-l-4 border-emerald-500 pl-4 py-1">
                    <p class="font-arab text-xl text-slate-800 mb-1" dir="rtl">وَلَوْ أُخْرِجَتِ الزَّكَاةُ... لَمَا بَقِيَ فَقِيرٌ أَبَدًا</p>
                    <p class="text-slate-700 font-medium italic mb-1">"Jika zakat ditunaikan dengan benar, niscaya tidak akan ada orang miskin di muka bumi."</p>
                    <footer class="text-xs text-emerald-600 font-bold">— Habib Muhammad bin Ahmad asy-Syathiri, Syarh Yaqut an-Nafis</footer>
                </blockquote>
            </div>

            <!-- FOTO 3: Jenis Zakat -->
            <div class="order-1 md:order-2">
                <div class="relative rounded-[2.5rem] overflow-hidden shadow-xl h-full min-h-[300px]">
                    <img src="https://images.unsplash.com/photo-1579621970588-a35d0e7ab9b6?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover" alt="Uang/Zakat">
                    <div class="absolute inset-0 bg-slate-900/70"></div>
                    
                    <div class="relative z-10 p-8 md:p-10 h-full flex flex-col justify-center text-white">
                        <h2 class="text-3xl font-extrabold text-white mb-8 flex items-center gap-3">
                            <i class="fa-solid fa-coins text-yellow-400"></i> 5. Jenis-Jenis Zakat
                        </h2>
                        
                        <div class="space-y-6">
                            <!-- Fitrah -->
                            <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/20">
                                <h3 class="text-xl font-bold text-yellow-400 mb-2">Zakat Fitrah</h3>
                                <ul class="text-sm text-slate-200 space-y-1 mb-3">
                                    <li>• Wajib bagi setiap Muslim</li>
                                    <li>• Dikeluarkan sebelum Idul Fitri</li>
                                    <li>• Besaran: ± 1 sha’ (2,5 – 3 kg makanan pokok)</li>
                                </ul>
                                <p class="text-xs text-white bg-black/30 inline-block px-3 py-1 rounded-full"><i class="fa-solid fa-book mr-1"></i> Dalil: HR. Bukhari & Muslim</p>
                            </div>
                            
                            <!-- Mal -->
                            <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/20">
                                <h3 class="text-xl font-bold text-yellow-400 mb-2">Zakat Mal</h3>
                                <p class="text-sm text-slate-200 mb-2">Meliputi: Emas & perak, Perdagangan, Pertanian, Peternakan, Penghasilan.</p>
                                <p class="font-arab text-lg text-right text-white mb-1" dir="rtl">وَفِي أَمْوَالِهِمْ حَقٌّ لِلسَّائِلِ وَالْمَحْرُومِ</p>
                                <p class="text-xs text-emerald-200 text-right">(QS. Adz-Dzariyat: 19)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- 6, 7 & 8: MUSTAHIQ & PENYALURAN -->
        <section>
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-emerald-600 font-bold tracking-widest uppercase text-sm">Siapa yang berhak?</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-800 mt-2 mb-6">6. Golongan Penerima Zakat (Mustahiq)</h2>
                <p class="font-arab text-2xl text-emerald-900 leading-relaxed mb-3" dir="rtl">
                    إِنَّمَا الصَّدَقَاتُ لِلْفُقَرَاءِ وَالْمَسَاكِينِ وَالْعَامِلِينَ عَلَيْهَا وَالْمُؤَلَّفَةِ قُلُوبُهُمْ وَفِي الرِّقَابِ وَالْغَارِمِينَ وَفِي سَبِيلِ اللَّهِ وَابْنِ السَّبِيلِ
                </p>
                <p class="text-slate-500 font-medium">(QS. At-Taubah: 60)</p>
            </div>

            <!-- FOTO 4: Mustahiq/Tangan Memberi disamping Grid 8 Golongan -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-5 h-[400px] rounded-[2.5rem] overflow-hidden shadow-lg relative">
                    <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Memberi Zakat">
                    <div class="absolute inset-0 bg-emerald-900/20"></div>
                </div>
                
                <div class="lg:col-span-7">
                    <!-- Grid 8 Golongan -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
                        <div class="bg-white border border-emerald-100 rounded-2xl p-4 text-center hover:bg-emerald-50 transition shadow-sm">
                            <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xl mb-2"><i class="fa-solid fa-user-slash"></i></div>
                            <h4 class="font-bold text-slate-800 text-sm">Fakir</h4>
                        </div>
                        <div class="bg-white border border-emerald-100 rounded-2xl p-4 text-center hover:bg-emerald-50 transition shadow-sm">
                            <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xl mb-2"><i class="fa-solid fa-house-chimney-crack"></i></div>
                            <h4 class="font-bold text-slate-800 text-sm">Miskin</h4>
                        </div>
                        <div class="bg-white border border-emerald-100 rounded-2xl p-4 text-center hover:bg-emerald-50 transition shadow-sm">
                            <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xl mb-2"><i class="fa-solid fa-clipboard-user"></i></div>
                            <h4 class="font-bold text-slate-800 text-sm">Amil</h4>
                        </div>
                        <div class="bg-white border border-emerald-100 rounded-2xl p-4 text-center hover:bg-emerald-50 transition shadow-sm">
                            <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xl mb-2"><i class="fa-solid fa-handshake-angle"></i></div>
                            <h4 class="font-bold text-slate-800 text-sm">Muallaf</h4>
                        </div>
                        <div class="bg-white border border-emerald-100 rounded-2xl p-4 text-center hover:bg-emerald-50 transition shadow-sm">
                            <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xl mb-2"><i class="fa-solid fa-link-slash"></i></div>
                            <h4 class="font-bold text-slate-800 text-sm">Riqab</h4>
                        </div>
                        <div class="bg-white border border-emerald-100 rounded-2xl p-4 text-center hover:bg-emerald-50 transition shadow-sm">
                            <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xl mb-2"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                            <h4 class="font-bold text-slate-800 text-sm">Gharim</h4>
                        </div>
                        <div class="bg-white border border-emerald-100 rounded-2xl p-4 text-center hover:bg-emerald-50 transition shadow-sm">
                            <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xl mb-2"><i class="fa-solid fa-mosque"></i></div>
                            <h4 class="font-bold text-slate-800 text-sm">Fi Sabilillah</h4>
                        </div>
                        <div class="bg-white border border-emerald-100 rounded-2xl p-4 text-center hover:bg-emerald-50 transition shadow-sm">
                            <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xl mb-2"><i class="fa-solid fa-person-walking-luggage"></i></div>
                            <h4 class="font-bold text-slate-800 text-sm">Ibnu Sabil</h4>
                        </div>
                    </div>

                    <!-- 7 & 8 Penyaluran & Hukum Penggantian -->
                    <div class="bg-emerald-50 rounded-[2rem] p-6 md:p-8 border border-emerald-100">
                        <h3 class="text-xl font-bold text-emerald-800 mb-4">7 & 8. Penyaluran & Bentuk Zakat Mal</h3>
                        <p class="text-sm text-slate-600 mb-6">Zakat dapat disalurkan melalui Lembaga Amil resmi (seperti Masjid) atau langsung kepada Mustahiq. Terkait bentuk penyaluran, terdapat perbedaan pandangan Ulama:</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-white p-5 rounded-2xl shadow-sm border-l-4 border-emerald-500">
                                <h4 class="font-bold text-slate-800 mb-2">Mayoritas (Syafi’i, Maliki, Hanbali)</h4>
                                <p class="text-xs text-slate-600 mb-2">Tidak boleh mengganti zakat dengan nilai/barang lain.</p>
                                <p class="font-arab text-sm text-right text-emerald-800 mb-1" dir="rtl">لَا يَجُوزُ إِخْرَاجُ الْقِيمَةِ...</p>
                                <p class="text-[10px] text-slate-400 text-right">(Imam An-Nawawi)</p>
                            </div>
                            <div class="bg-white p-5 rounded-2xl shadow-sm border-l-4 border-yellow-400">
                                <h4 class="font-bold text-slate-800 mb-2">Mazhab Hanafi</h4>
                                <p class="text-xs text-slate-600">Membolehkan zakat dalam bentuk nilai/barang yang setara. <strong>Alasannya:</strong> Untuk kemudahan & demi kemaslahatan penerima.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 9 & 10: KESIMPULAN & CALL TO ACTION (FOTO 5) -->
        <section class="relative rounded-[3rem] overflow-hidden shadow-2xl">
            <!-- FOTO 5: CTA Background -->
            <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover" alt="Interior Masjid">
            <div class="absolute inset-0 bg-emerald-900/90 mix-blend-multiply"></div>
            
            <div class="relative z-10 p-8 md:p-16 flex flex-col md:flex-row items-center justify-between gap-10">
                <div class="w-full md:w-3/5 text-white">
                    <h2 class="text-3xl font-extrabold mb-6"><span class="text-emerald-400">9. Kesimpulan:</span> Solusi Ekonomi Umat</h2>
                    <ul class="space-y-3 mb-8 text-slate-200">
                        <li class="flex gap-3"><i class="fa-solid fa-circle-check text-emerald-400 mt-1"></i> Zakat adalah kewajiban penting dan memiliki fungsi ibadah serta sosial.</li>
                        <li class="flex gap-3"><i class="fa-solid fa-circle-check text-emerald-400 mt-1"></i> Dapat menjadi solusi ekonomi umat jika dikelola dengan benar.</li>
                        <li class="flex gap-3"><i class="fa-solid fa-circle-check text-emerald-400 mt-1"></i> Perbedaan pendapat fiqih menunjukkan keluasan dan keindahan syariat.</li>
                    </ul>
                </div>
                
                <div class="w-full md:w-2/5 bg-white p-8 rounded-3xl text-center shadow-xl transform hover:scale-105 transition duration-300">
                    <h3 class="text-2xl font-black text-slate-800 mb-2">10. Ayo Tunaikan Zakat!</h3>
                    <p class="text-sm text-slate-500 mb-6">Mari tunaikan zakat Anda melalui Masjid Agung agar tepat sasaran, amanah, dan sesuai syariat.</p>
                    
                    <button @click="openModal()" class="w-full py-4 px-6 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition shadow-lg shadow-emerald-200 flex items-center justify-center">
                        <i class="fa-solid fa-wallet mr-2"></i> Bayar Zakat Sekarang
                    </button>
                    <p class="text-xs text-slate-400 mt-4"><i class="fa-solid fa-shield-halal mr-1"></i> Dikelola oleh Amil Resmi Masjid</p>
                </div>
            </div>
        </section>

    </main>
    @include('Infaq.zakat')
    @include('footer')
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