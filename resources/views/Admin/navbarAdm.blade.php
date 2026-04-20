<aside class="w-64 bg-green-900 text-white flex flex-col hidden md:flex flex-shrink-0">
    <div class="h-20 flex items-center justify-center border-b border-green-800 px-4">
        <h1 class="text-xl font-bold flex items-center gap-2 text-green-100">
            <i class="fa-solid fa-mosque"></i> Admin Masjid
        </h1>
    </div>
    <nav class="flex-1 overflow-y-auto py-6 space-y-2 px-4">
        
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition border-l-4 
           {{ request()->routeIs('admin.dashboard') ? 'bg-green-800 text-white border-white' : 'text-green-200 hover:bg-green-800 hover:text-white border-transparent' }}">
            <i class="fa-solid fa-chart-line w-5"></i> Dashboard
        </a>

        <a href="{{ route('admin.berita') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition border-l-4 
           {{ request()->routeIs('admin.berita') ? 'bg-green-800 text-white border-white' : 'text-green-200 hover:bg-green-800 hover:text-white border-transparent' }}">
            <i class="fa-solid fa-newspaper w-5"></i> Berita
        </a>

        <a href="{{ route('admin.pencatatan') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition border-l-4 
           {{ request()->routeIs('admin.pencatatan') ? 'bg-green-800 text-white border-white' : 'text-green-200 hover:bg-green-800 hover:text-white border-transparent' }}">
            <i class="fa-solid fa-book-open w-5"></i> Pencatatan
        </a>
        
    </nav>
    <div class="p-4 border-t border-green-800">
        <a href="{{ route('login') }}" class="flex items-center gap-2 text-sm text-red-300 hover:text-red-100 transition">
            <i class="fa-solid fa-right-from-bracket"></i> Keluar
        </a>
    </div>
</aside>