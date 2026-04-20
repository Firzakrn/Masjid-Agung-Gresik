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
                            <a href="/profile/sejarah" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Sejarah</a>
                        </div>
                        <div class="py-2">
                            <a href="/profile/struktur" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Struktur Organisasi</a>
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <button class="text-gray-700 hover:text-green-600 font-semibold flex items-center transition duration-300 pb-2 border-b-2 border-transparent group-hover:border-green-600">
                        Kegiatan 
                    </button>
                    <div class="absolute left-0 top-full mt-0 w-48 bg-white border border-gray-100 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="/kegiatan/agenda" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Agenda Masjid</a>
                            <a href="/kegiatan/kajian" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Kajian</a>
                            <a href="/kegiatan/pendidikan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Pendidikan</a>
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <button class="text-gray-700 hover:text-green-600 font-semibold flex items-center transition duration-300 pb-2 border-b-2 border-transparent group-hover:border-green-600">
                        Reservasi 
                    </button>
                    <div class="absolute left-0 top-full mt-0 w-48 bg-white border border-gray-100 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="/reservasi/gedung" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Gedung</a>
                            <a href="/reservasi/lapangan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Lapangan</a>
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <button class="text-gray-700 hover:text-green-600 font-semibold flex items-center transition duration-300 pb-2 border-b-2 border-transparent group-hover:border-green-600">
                        Infaq 
                    </button>
                    <div class="absolute left-0 top-full mt-0 w-48 bg-white border border-gray-100 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="/infaq/pencatatan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Catatan Pendapatan</a>
                            <a href="/infaq/infaq" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Infaq</a>
                            <a href="/infaq/zakat" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Zakat</a>
                            <a href="/infaq/donasi" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">Donasi</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('login') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1.5 px-5 rounded-md shadow transition duration-300 text-sm">
                    Login
                </a>
            </nav>

        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200 shadow-inner">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/profile" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 rounded-md">Profile</a>
            <a href="/kegiatan" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 rounded-md">Kegiatan</a>
            <a href="/reservasi" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 rounded-md">Reservasi</a>
            <a href="/infaq" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 rounded-md">Infaq</a>
            <a href="/login" class="block px-3 py-2 text-base font-medium text-green-600 font-bold hover:bg-gray-50 rounded-md">Login</a>
        </div>
    </div>
</header>

<script>
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');
    
    btn.addEventListener('click', () => {
        // Efek slide simpel untuk mobile menu
        menu.classList.toggle('hidden');
    });
</script>