<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Tanggal & Sesi - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col relative z-0">

    @php
        $paket = request('paket', 'Paket Belum Dipilih');
        $dp = 0;
        $harga_paket = 0; 
        $isAula = false;
        $bgImage = 'majlis.jpg';

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
        } elseif (stripos($paket, 'Wisuda') !== false) {
            $harga_paket = 7500000;
            $dp = 2000000;
            $isAula = true;
            $bgImage = 'wisuda.jpg'; 
        } elseif (stripos($paket, 'Majelis') !== false) {
            $harga_paket = 7500000;
            $dp = 2000000;
            $isAula = true;
            $bgImage = 'majlis.jpg'; 
        } 

        $backUrl = route('reservasi.wedding'); // Default kembali ke menu reservasi
        if (stripos($paket, 'Workshop') !== false || stripos($paket, 'Wisuda') !== false || stripos($paket, 'Majelis') !== false || stripos($paket, 'Social Event') !== false) {
            $backUrl = route('reservasi.socialevent'); 
        }

    @endphp

    <img src="{{ asset('images/reservasi/' . $bgImage) }}" alt="Background" class="fixed inset-0 w-full h-full object-cover opacity-30 -z-10">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-12 w-full flex-grow">
        
        <div class="mb-8">
            <a href="{{ $backUrl }}" class="text-sm font-bold text-slate-900 hover:text-green-600 transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- PROGRESS BAR -->
        <div class="flex items-center justify-center gap-2 md:gap-6 mb-12 overflow-x-auto pb-4">
            
            <!-- STEP 1: JADWAL (Aktif) -->
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 border border-blue-200 font-bold flex items-center justify-center text-lg shadow-sm">
                    1
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-blue-700">Penjadwalan</p>
                </div>
            </div>

            <div class="w-6 md:w-12 h-0.5 bg-slate-200"></div>

            <!-- STEP 2: LOGIN (cek) -->
            <div class="flex items-center gap-3 @guest opacity-50 @endguest">
                <div class="w-8 h-8 rounded-full @auth bg-blue-600 text-white shadow-sm @else bg-slate-100 text-slate-400 @endauth font-bold flex items-center justify-center text-lg">
                    @auth
                        <i class="fa-solid fa-check text-sm"></i>
                    @else
                        2
                    @endauth
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800">Login</p>
                </div>
            </div>

            <div class="w-6 md:w-12 h-0.5 bg-slate-200"></div>

            <!-- STEP 3: FORMULIR (Menunggu) -->
            <div class="flex items-center gap-3 opacity-50">
                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-400 font-bold flex items-center justify-center text-lg shadow-sm">
                    3
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800">Formulir Data</p>
                </div>
            </div>

            <div class="w-6 md:w-12 h-0.5 bg-slate-200"></div>

            <!-- STEP 4: PEMBAYARAN (Menunggu) -->
            <div class="flex items-center gap-3 opacity-50">
                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-400 font-bold flex items-center justify-center text-lg">
                    4
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-bold text-slate-800">Pembayaran</p>
                </div>
            </div>

        </div>

        <!-- HEADER -->
        <div class="bg-green-700 p-8 text-center text-white rounded-t-3xl shadow-lg relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-green-400 font-bold uppercase tracking-widest text-sm mb-2">Tahap 1: Penjadwalan Acara</p>
                <h1 class="text-3xl font-extrabold mb-2">{{ $paket }}</h1>
                <p class="text-slate-200 text-sm">Pilih tanggal dan sesi yang tersedia untuk melanjutkan proses reservasi.</p>
            </div>
        </div>

        <div class="bg-white p-6 md:p-10 rounded-b-3xl shadow-xl border border-slate-100 mb-8">
            
            <!-- BLOK ATURAN & KETENTUAN -->
            <div x-data="{ openAturan: false }" class="mb-10 border border-orange-200 rounded-2xl overflow-hidden shadow-sm">
                <button type="button" @click="openAturan = !openAturan" class="w-full bg-orange-50 hover:bg-orange-100 transition px-6 py-4 flex justify-between items-center text-orange-900 focus:outline-none">
                    <span class="font-bold flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation"></i> Ketentuan & Aturan Berlaku
                    </span>
                    <svg :class="openAturan ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-show="openAturan" x-collapse class="px-6 py-5 bg-white text-sm text-slate-700 space-y-6">
                    <div>
                        <h4 class="font-bold text-slate-900 mb-2">Aturan Umum Kawasan Masjid</h4>
                        <ul class="list-disc list-inside space-y-1.5 text-slate-600">
                            <li>Dilarang menempelkan benda atau paku/sejenisnya pada dinding dan fasilitas.</li>
                            <li>Dilarang membawa makanan basah ke area tertentu.</li>
                            <li>Wajib menjaga kebersihan dan kesucian lingkungan masjid.</li>
                            <li>Wajib berbusana muslim/muslimah bagi seluruh tamu dan panitia.</li>
                        </ul>
                    </div>

                    @if($isAula)
                    <div class="pt-4 border-t border-slate-100">
                        <h4 class="font-bold text-slate-900 mb-2">Peraturan Khusus Aula Utama & Islamic Center</h4>
                        <ul class="list-disc list-inside space-y-1.5 text-slate-600">
                            <li><strong>Acara Pagi:</strong> Mulai 07.00 - 12.00 WIB. (Pemasangan dekorasi & catering: H-1 Jam 23.00 WIB).</li>
                            <li><strong>Acara Malam:</strong> Mulai 17.00 - 22.00 WIB. (Pemasangan dekorasi & catering: Jam 13.00 WIB).</li>
                            <li>Pemasangan sebelum waktu yang ditentukan dikenakan <em>charge</em> Rp 100.000/jam.</li>
                            <li>Penambahan durasi acara dikenakan <em>charge</em> Rp 300.000/jam.</li>
                            <li>Musik atau hiburan wajib bernuansa religi.</li>
                            <li>Pengantin wanita dan keluarga besarnya wajib mengenakan hijab.</li>
                        </ul>
                    </div>
                    @endif

                    <div class="pt-4 border-t border-slate-100">
                        <h4 class="font-bold text-slate-900 mb-2">Kebijakan Pembayaran</h4>
                        <ul class="list-disc list-inside space-y-1.5 text-slate-600">
                            <li>Pelunasan pembayaran dilakukan maksimal 2 minggu sebelum hari H.</li>
                            <li>Apabila terjadi pembatalan acara, maka DP dianggap hangus (kecuali <em>reschedule</em> yang disetujui).</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- KOMPONEN KALENDER ALPINE.JS -->
            <div x-data="calendarData()" x-init="initCalendar()">
                
                <!-- Header Kalender -->
                <div class="flex items-center justify-between mb-6">
                    <button @click="changeMonth(-1)" class="w-10 h-10 rounded-full hover:bg-slate-100 flex items-center justify-center text-slate-600 transition">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <h2 class="text-xl font-bold text-slate-800" x-text="monthNames[month] + ' ' + year"></h2>
                    <button @click="changeMonth(1)" class="w-10 h-10 rounded-full hover:bg-slate-100 flex items-center justify-center text-slate-600 transition">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Grid Kalender -->
                <div class="grid grid-cols-7 gap-2 mb-4 text-center">
                    <template x-for="day in ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']">
                        <div class="font-bold text-sm text-slate-500 py-2" x-text="day"></div>
                    </template>
                </div>

                <div class="grid grid-cols-7 gap-2 gap-y-3">
                    <!-- Sel kosong sebelum tanggal 1 -->
                    <template x-for="blankday in blankdays">
                        <div class="p-4 border border-transparent rounded-lg"></div>
                    </template>
                    
                    <!-- Sel Tanggal -->
                    <template x-for="date in no_of_days">
                        <div @click="selectDate(date)" 
                             class="p-4 flex items-center justify-center rounded-lg cursor-pointer transition border"
                             :class="{
                                 'bg-blue-600 text-white border-blue-600 shadow-md font-bold': isSelectedDate(date),
                                 'bg-slate-50 border-slate-200 hover:bg-green-50 hover:border-green-300 text-slate-700': !isSelectedDate(date) && !isPastDate(date),
                                 'bg-slate-100 text-slate-400 border-slate-100 cursor-not-allowed': isPastDate(date),
                                 'bg-yellow-100 border-yellow-300': hasEvent(date) === 'pagi' && !isSelectedDate(date),
                                 'bg-sky-100 border-sky-300': hasEvent(date) === 'malam' && !isSelectedDate(date),
                                 'bg-red-100 border-red-300 text-red-500 cursor-not-allowed text-opacity-50': hasEvent(date) === 'full'
                             }">
                             <span x-text="date" class="text-lg"></span>
                        </div>
                    </template>
                </div>

                <!-- KETERANGAN WARNA KALENDER -->
                <div class="flex flex-wrap items-center justify-center gap-4 md:gap-8 mt-6 pt-6 border-t border-slate-100 mb-8">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded bg-slate-50 border border-slate-200"></div>
                        <span class="text-xs text-slate-600 font-semibold">Tersedia</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded bg-sky-100 border border-sky-300"></div>
                        <span class="text-xs text-slate-600 font-semibold">Tersisa Sesi Pagi</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded bg-yellow-100 border border-yellow-300"></div>
                        <span class="text-xs text-slate-600 font-semibold">Tersisa Sesi Malam</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded bg-red-100 border border-red-300"></div>
                        <span class="text-xs text-slate-600 font-semibold">Penuh</span>
                    </div>
                </div>

                <!-- Pemilihan Sesi -->
                <div x-show="selectedDate" class="p-6 bg-slate-50 border border-slate-200 rounded-2xl mb-8">
                    <h3 class="font-bold text-slate-800 mb-4 border-b border-slate-200 pb-2">Pilih Sesi untuk <span x-text="formatSelectedDate()"></span></h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Sesi Pagi -->
                        <button @click="selectSession('pagi')" 
                                :disabled="hasEvent(selectedDate) === 'pagi' || hasEvent(selectedDate) === 'full'"
                                class="p-4 rounded-xl border-2 text-left transition relative overflow-hidden"
                                :class="{
                                    'border-green-500 bg-green-50': selectedSession === 'pagi',
                                    'border-slate-200 bg-white hover:border-green-300': selectedSession !== 'pagi' && hasEvent(selectedDate) !== 'pagi' && hasEvent(selectedDate) !== 'full',
                                    'border-red-200 bg-red-50 opacity-50 cursor-not-allowed': hasEvent(selectedDate) === 'pagi' || hasEvent(selectedDate) === 'full'
                                }">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="font-bold text-slate-800">Sesi Pagi</p>
                                    <p class="text-sm text-slate-500">07:00 - 12:00 WIB</p>
                                </div>
                                <div x-show="selectedSession === 'pagi'" class="w-6 h-6 rounded-full bg-green-500 text-white flex items-center justify-center">
                                    <i class="fa-solid fa-check text-xs"></i>
                                </div>
                                <div x-show="hasEvent(selectedDate) === 'pagi' || hasEvent(selectedDate) === 'full'" class="text-xs font-bold text-red-500 bg-red-100 px-2 py-1 rounded">
                                    Terpakai
                                </div>
                            </div>
                        </button>
                        
                        <!-- Sesi Malam -->
                        <button @click="selectSession('malam')" 
                                :disabled="hasEvent(selectedDate) === 'malam' || hasEvent(selectedDate) === 'full'"
                                class="p-4 rounded-xl border-2 text-left transition relative overflow-hidden"
                                :class="{
                                    'border-green-500 bg-green-50': selectedSession === 'malam',
                                    'border-slate-200 bg-white hover:border-green-300': selectedSession !== 'malam' && hasEvent(selectedDate) !== 'malam' && hasEvent(selectedDate) !== 'full',
                                    'border-red-200 bg-red-50 opacity-50 cursor-not-allowed': hasEvent(selectedDate) === 'malam' || hasEvent(selectedDate) === 'full'
                                }">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="font-bold text-slate-800">Sesi Malam</p>
                                    <p class="text-sm text-slate-500">17:00 - 22:00 WIB</p>
                                </div>
                                <div x-show="selectedSession === 'malam'" class="w-6 h-6 rounded-full bg-green-500 text-white flex items-center justify-center">
                                    <i class="fa-solid fa-check text-xs"></i>
                                </div>
                                <div x-show="hasEvent(selectedDate) === 'malam' || hasEvent(selectedDate) === 'full'" class="text-xs font-bold text-red-500 bg-red-100 px-2 py-1 rounded">
                                    Terpakai
                                </div>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Form Redirect -->
                <form action="{{ route('reservasi.formulir') }}" method="GET" x-show="selectedDate && selectedSession">
                    <input type="hidden" name="paket" value="{{ $paket }}">
                    <input type="hidden" name="tanggal" :value="formatSelectedDate()">
                    <input type="hidden" name="sesi" :value="selectedSession === 'pagi' ? 'Pagi (07.00 - 12.00 WIB)' : 'Malam (17.00 - 22.00 WIB)'">
                    
                    <button type="submit" class="w-full bg-green-900 text-white p-4 rounded-2xl font-bold text-lg hover:bg-green-600 transition-colors shadow-lg flex justify-center items-center gap-2">
                        @auth
                            Lanjutkan ke Formulir Data
                        @else
                            Login untuk Melanjutkan
                        @endauth
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

            </div>

        </div>
    </div>

    <script>
        function calendarData() {
            return {
                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],
                monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                
                selectedDate: null,
                selectedSession: null,
                
                // Data simulasi tanggal yang sudah dibooking.
                bookedDates: {
                    '2026-05-15': 'pagi',   // Kuning (Sisa Malam)
                    '2026-05-20': 'malam',  // Biru (Sisa Pagi)
                    '2026-05-25': 'full'    // Merah (Penuh)
                },

                initCalendar() {
                    let today = new Date();
                    this.month = today.getMonth();
                    this.year = today.getFullYear();
                    this.getNoOfDays();
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                    let dayOfWeek = new Date(this.year, this.month).getDay();
                    let blankdaysArray = [];
                    let startingDay = dayOfWeek === 0 ? 6 : dayOfWeek - 1;
                    
                    for (var i = 1; i <= startingDay; i++) {
                        blankdaysArray.push(i);
                    }
                    
                    let daysArray = [];
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }
                    
                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                },

                changeMonth(val) {
                    this.month += val;
                    if (this.month < 0) {
                        this.month = 11;
                        this.year--;
                    }
                    if (this.month > 11) {
                        this.month = 0;
                        this.year++;
                    }
                    this.getNoOfDays();
                    this.selectedDate = null;
                    this.selectedSession = null;
                },

                isPastDate(date) {
                    let today = new Date();
                    today.setHours(0,0,0,0);
                    let checkDate = new Date(this.year, this.month, date);
                    return checkDate < today;
                },

                selectDate(date) {
                    if(this.isPastDate(date) || this.hasEvent(date) === 'full') return;
                    this.selectedDate = date;
                    this.selectedSession = null; 
                },

                isSelectedDate(date) {
                    return this.selectedDate === date;
                },

                formatSelectedDate() {
                    if(!this.selectedDate) return '';
                    let d = new Date(this.year, this.month, this.selectedDate);
                    return `${d.getDate()} ${this.monthNames[d.getMonth()]} ${d.getFullYear()}`;
                },
                
                getFormattedDateString(date) {
                     let d = new Date(this.year, this.month, date);
                     let m = '' + (d.getMonth() + 1);
                     let day = '' + d.getDate();
                     if (m.length < 2) m = '0' + m;
                     if (day.length < 2) day = '0' + day;
                     return [d.getFullYear(), m, day].join('-');
                },

                hasEvent(date) {
                    let dateStr = this.getFormattedDateString(date);
                    return this.bookedDates[dateStr] || null;
                },

                selectSession(session) {
                    this.selectedSession = session;
                }
            }
        }
    </script>
</body>
</html>