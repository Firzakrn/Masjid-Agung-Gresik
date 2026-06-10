<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    
    @include('navbar')

    <main class="flex-grow max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        
        <div class="mb-10 rounded-2xl overflow-hidden shadow-lg border-4 border-white bg-black">
            <iframe class="w-full h-[300px] md:h-[500px]" src="https://www.youtube.com/embed/QHdEdKB0SZo?si=6N857t2HQnISFCPm" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-10 relative">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-gray-200 pb-4 mb-6 gap-4">
                <h1 class="text-3xl md:text-4xl font-bold text-green-800">Sejarah Masjid</h1>

                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500 font-medium">Bagikan:</span>
                    
                    <a href="#" id="share-wa" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600 hover:-translate-y-1 transition-all shadow-md">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                    </a>
                    
                    <a href="#" id="share-fb" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 hover:-translate-y-1 transition-all shadow-md">
                        <i class="fa-brands fa-facebook-f text-lg"></i>
                    </a>
                    
                    <a href="#" id="share-tw" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-black text-white hover:bg-gray-800 hover:-translate-y-1 transition-all shadow-md">
                        <i class="fa-brands fa-x-twitter text-lg"></i>
                    </a>
                    
                    <button type="button" id="share-ig" class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 text-white hover:opacity-90 hover:-translate-y-1 transition-all shadow-md cursor-pointer">
                        <i class="fa-brands fa-instagram text-xl"></i>
                    </button>
                </div>
            </div>

            <div class="text-gray-700 leading-relaxed space-y-5 text-justify">
                <p>
                    Masjid Agung Gresik, yang juga dikenal sebagai Masjid Jami' Gresik, memiliki sejarah panjang yang mencerminkan perkembangan agama Islam di wilayah Gresik. Masjid ini didirikan pada abad ke-15, sekitar tahun 1421 Masehi, oleh seorang ulama terkenal bernama Maulana Malik Ibrahim. Maulana Malik Ibrahim adalah salah satu penyebar Islam pertama di Nusantara dan dianggap sebagai wali songo (sembilan wali) yang berperan penting dalam penyebaran agama Islam di Jawa.
                </p>
                <p>
                    Masjid Agung Gresik awalnya dibangun sebagai tempat ibadah dan pusat kegiatan keagamaan bagi komunitas Muslim di Gresik. Seiring berjalannya waktu, masjid ini mengalami beberapa kali renovasi dan perluasan untuk mengakomodasi jumlah jamaah yang semakin banyak. Arsitektur masjid ini mencerminkan gaya arsitektur tradisional Jawa dengan sentuhan Islam, termasuk penggunaan atap joglo dan ornamen khas Jawa.
                </p>
                <p>
                    Masjid Agung Gresik terletak di Jalan Dr. Wahidin Sudiro Husodo, Desa Kembangan Kecamatan Kebomas. Masjid ini diresmikan oleh Bupati Gresik kala itu, yaitu Bapak Drs. KH. Robbach Ma’sum, MM pada tanggal 27 Februari 2004. Dan masjid ini menjadi salah satu masjid yang dibanggakan oleh masyarakat Gresik.
                </p>
                <p>
                    Dilihat dari luar bangunan, masjid ini didominasi warna biru muda dengan ornamen-ornamen cantik berkelir hijau. Masjid yang bernama lain Masjid Agung Syeh Maulana Malik Ibrahim ini terdiri dari tiga lantai, di mana lantai pertama setelah lantai dasar adalah ruang salat utama.
                </p>
                <p>
                    Memasuki masjid, pengunjung akan menemui pintu-pintu dari kayu yang berdiri kokoh dengan hiasan-hiasan kaligrafi. Aksen-aksen bangunan berbentuk kuba-kuba kecil yang berdiri rapi memanjang juga turut berperan mempercantik masjid ini.
                </p>
            </div>

            <div class="mt-10 p-5 bg-green-50 border border-green-100 rounded-xl text-sm text-gray-600">
                <h4 class="font-bold text-green-800 mb-2"><i class="fa-solid fa-book-open mr-2"></i>Sumber Referensi:</h4>
                <ul class="space-y-2 ml-1">
                    <li><i class="fa-solid fa-location-dot w-5 text-green-600"></i> Lokasi: Masjid Agung Maulana Malik Ibrahim Gresik</li>
                    <li><i class="fa-solid fa-link w-5 text-green-600"></i> <a href="https://disparekrafbudpora.gresikkab.go.id/detailpost/masjid-jami-gresik" target="_blank" class="hover:text-green-700 hover:underline">disparbud@gresikkab.go.id - Masjid Jami’ Gresik </a></li>
                    <li><i class="fa-brands fa-facebook w-5 text-green-600"></i> <a href="https://web.facebook.com/photo.php?fbid=1051032282349862&set=a.452044495581980&id=100063673736434&_rdc=1&_rdr#" target="_blank" class="hover:text-green-700 hover:underline">Dokumentasi Facebook</a></li>
                </ul>
            </div>

        </div>
    </main>

    @include('footer')

    <script>
        const urlHome = "{{ url('/') }}";         
        const textShare = "Masjid Agung Gresik terletak di Jalan Dr. Wahidin Sudiro Husodo, Desa Kembangan Kecamatan Kebomas. Masjid ini diresmikan oleh Bupati Gresik kala itu, yaitu Bapak Drs. KH. Robbach Ma’sum, MM pada tanggal 27 Februari 2004. Dan masjid ini menjadi salah satu masjid yang dibanggakan oleh masyarakat Gresik. Kunjungi web kami: ";
        
        const encodedText = encodeURIComponent(textShare);
        const encodedUrl = encodeURIComponent(urlHome);

        document.getElementById('share-wa').href = `https://wa.me/?text=${encodedText}${encodedUrl}`;
        document.getElementById('share-tw').href = `https://twitter.com/intent/tweet?text=${encodedText}&url=${encodedUrl}`;
        document.getElementById('share-fb').href = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}&quote=${encodedText}`;
        document.getElementById('share-ig').addEventListener('click', function(e) {
            e.preventDefault();
            const fullText = textShare + urlHome;
            
            navigator.clipboard.writeText(fullText).then(() => {
                alert('Teks dan Link berhasil disalin!\nSilakan paste (tempel) di DM atau Caption Instagram kamu.');
            }).catch(err => {
                alert('Gagal menyalin teks. Silakan coba lagi.');
            });
        });
    </script>
</body>
</html>