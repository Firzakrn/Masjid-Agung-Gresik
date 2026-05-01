<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col">
            
            <div class="flex justify-between md:justify-center items-center h-20 relative pt-2 md:pt-4">
                
                <div class="flex-shrink-0 flex items-center">
                    <a href="/">
                        <img src="{{ asset('images/logoo.png') }}" alt="Logo Masjid Agung Gresik" class="h-14 md:h-16 w-auto transition-transform hover:scale-105">
                    </a>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-green-600 focus:outline-none p-2 rounded-md hover:bg-gray-100">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

            </div>

            <nav class="hidden md:flex justify-center space-x-8 items-center py-4">
                <div class="relative group">
                    <button class="text-gray-700 hover:text-green-600 font-semibold flex items-center transition duration-300 pb-2 border-b-2 border-transparent group-hover:border-green-600">
                        Profile
                    </button>
                    <div class="absolute left-0 top-full mt-0 w-48 bg-white border border-gray-100 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="{{ url('/profile/sejarah') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Sejarah</a>
                            <a href="{{ url('/profile/struktur') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Struktur Organisasi</a>
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <button class="text-gray-700 hover:text-green-600 font-semibold flex items-center transition duration-300 pb-2 border-b-2 border-transparent group-hover:border-green-600">
                        Kegiatan 
                    </button>
                    <div class="absolute left-0 top-full mt-0 w-48 bg-white border border-gray-100 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="{{ url('/kegiatan/semuaBerita') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Semua Berita</a>
                            <a href="{{ url('/kegiatan/agenda') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Agenda Masjid</a>
                            <a href="{{ url('/kegiatan/kajian') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Kajian</a>
                            <a href="{{ url('/kegiatan/pendidikan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Pendidikan</a>
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <button class="text-gray-700 hover:text-green-600 font-semibold flex items-center transition duration-300 pb-2 border-b-2 border-transparent group-hover:border-green-600">
                        Reservasi 
                    </button>
                    <div class="absolute left-0 top-full mt-0 w-48 bg-white border border-gray-100 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="{{ url('/reservasi/wedding') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Gedung Pernikahan</a>
                            <a href="{{ url('/reservasi/socialevent') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Gedung Event</a>
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <button class="text-gray-700 hover:text-green-600 font-semibold flex items-center transition duration-300 pb-2 border-b-2 border-transparent group-hover:border-green-600">
                        ZIS
                    </button>
                    <div class="absolute left-0 top-full mt-0 w-48 bg-white border border-gray-100 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="{{ url('/infaq/pencatatan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Catatan Keuangan Masjid</a>
                            <a href="{{ url('/infaq/zakat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Zakat</a>
                            <a href="{{ url('/infaq/infaq') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Infaq & Sedekah</a>
                        </div>
                    </div>
                </div>

                @guest
                    <a href="{{ route('login') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1.5 px-5 rounded-md shadow transition duration-300 text-sm">
                        Login
                    </a>
                @else
                    <div class="relative group">
                        <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-1.5 px-5 rounded-md shadow transition duration-300 text-sm flex items-center gap-2">
                            History {{ Auth::user()->name }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div class="absolute right-0 top-full mt-0 w-48 bg-white border border-gray-100 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="py-2">
                                <a href="{{ url('/riwayat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Riwayat</a>
                                
                                <form action="{{ route('logout') }}" method="POST" class="block w-full text-left m-0">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 font-bold border-t border-gray-100 mt-1 pt-2 transition">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </nav>

        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200 shadow-inner">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            
            <div x-data="{ openProfile: false }">
                <button @click="openProfile = !openProfile" class="w-full flex justify-between items-center px-3 py-2 text-base font-medium text-gray-800 focus:outline-none rounded-md hover:bg-gray-50">
                    <span>Profile</span>
                    <svg :class="openProfile ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openProfile" x-collapse style="display: none;" class="pl-5 space-y-1">
                    <a href="{{ url('/profile/sejarah') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-md">Sejarah</a>
                    <a href="{{ url('/profile/struktur') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-md">Struktur Organisasi</a>
                </div>
            </div>

            <div x-data="{ openKegiatan: false }" class="border-t border-gray-100 mt-1 pt-1">
                <button @click="openKegiatan = !openKegiatan" class="w-full flex justify-between items-center px-3 py-2 text-base font-medium text-gray-800 focus:outline-none rounded-md hover:bg-gray-50">
                    <span>Kegiatan</span>
                    <svg :class="openKegiatan ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openKegiatan" x-collapse style="display: none;" class="pl-5 space-y-1">
                    <a href="{{ url('/kegiatan/semuaBerita') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-md">Semua Berita</a>   
                    <a href="{{ url('/kegiatan/agenda') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-md">Agenda Masjid</a>
                    <a href="{{ url('/kegiatan/kajian') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-md">Kajian</a>
                    <a href="{{ url('/kegiatan/pendidikan') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-md">Pendidikan</a>
                </div>
            </div>

            <div x-data="{ openReservasi: false }" class="border-t border-gray-100 mt-1 pt-1">
                <button @click="openReservasi = !openReservasi" class="w-full flex justify-between items-center px-3 py-2 text-base font-medium text-gray-800 focus:outline-none rounded-md hover:bg-gray-50">
                    <span>Reservasi</span>
                    <svg :class="openReservasi ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openReservasi" x-collapse style="display: none;" class="pl-5 space-y-1">
                    <a href="{{ url('/reservasi/wedding') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-md">Gedung Pernikahan</a>
                    <a href="{{ url('/reservasi/socialevent') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-md">Gedung Event</a>
                </div>
            </div>

            <div x-data="{ openZis: false }" class="border-t border-gray-100 mt-1 pt-1">
                <button @click="openZis = !openZis" class="w-full flex justify-between items-center px-3 py-2 text-base font-medium text-gray-800 focus:outline-none rounded-md hover:bg-gray-50">
                    <span>ZIS</span>
                    <svg :class="openZis ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openZis" x-collapse style="display: none;" class="pl-5 space-y-1">
                    <a href="{{ url('/infaq/pencatatan') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-md">Catatan Keuangan Masjid</a>
                    <a href="{{ url('/infaq/zakat') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-md">Zakat</a>
                    <a href="{{ url('/infaq/infaq') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-md">Infaq & Sedekah</a>
                </div>
            </div>

            <div class="mt-4 pt-4 border-t border-gray-200" x-data="{ userMenuOpen: false }">
                @guest
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-bold text-green-600 hover:bg-green-50 rounded-md text-center border border-green-600 mx-3 mb-3">
                        Login
                    </a>
                @else
                    <div class="mx-3">
                        <button @click="userMenuOpen = !userMenuOpen" 
                                class="w-full flex justify-between items-center px-4 py-3 text-base font-bold text-green-700 bg-green-50 rounded-xl transition-all duration-300">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-user text-lg"></i>
                                {{ Auth::user()->name }}
                            </div>
                            <svg :class="userMenuOpen ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="userMenuOpen" 
                            x-collapse 
                            class="mt-2 bg-white border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                            <a href="{{ url('/riwayat') }}" class="block px-5 py-3 text-sm font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 transition">
                                <i class="fa-solid fa-receipt mr-2 w-5"></i> Riwayat
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="w-full text-left px-5 py-3 text-sm font-bold text-red-600 hover:bg-red-50 transition border-t border-gray-100">
                                    <i class="fa-solid fa-right-from-bracket mr-2 w-5"></i> Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

        </div>
    </div>
</header>

<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');
    
    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>