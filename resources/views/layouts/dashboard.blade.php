{{-- File: resources/views/layouts/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasbor Mahasiswa') - STIANUSA PMB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" href="{{ asset('storage/poto/LOGOSTIA.png') }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-slate-100 text-slate-800">
        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-30 w-64 transform bg-slate-800 text-white transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">

            <div class="flex items-center justify-center px-4 py-6">
                <span class="text-2xl font-extrabold text-white">STIANUSA PMB</span>
            </div>

            <div class="px-4 py-4 text-center border-t border-b border-slate-700">
                @if(Auth::user()->pendaftaran)
                <img src="{{ asset('storage/' . Auth::user()->pendaftaran->path_pas_foto) }}" alt="Foto Profil" class="w-24 h-28 object-cover mx-auto rounded-md border-2 border-slate-500">
                @else
                <div class="w-24 h-28 mx-auto rounded-md bg-slate-700 flex items-center justify-center"><span class="text-xs text-slate-400">Foto Tidak Ada</span></div>
                @endif
                <h4 class="mt-3 text-lg font-semibold">{{ Auth::user()->name }}</h4>
                <p class="text-sm text-slate-400">{{ Auth::user()->email }}</p>
            </div>

            <nav class="mt-4">
                <a href="{{ route('home') }}" class="flex items-center px-6 py-3 transition-colors duration-200 {{ request()->routeIs('home') ? 'text-slate-200 bg-slate-900/50' : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="mx-3">Dashboard</span>
                </a>

                <!-- MENU BARU DITAMBAHKAN DI SINI -->
                <a href="{{ route('pendaftaran.card') }}" class="flex items-center px-6 py-3 transition-colors duration-200 {{ request()->routeIs('pendaftaran.card') ? 'text-slate-200 bg-slate-900/50' : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span class="mx-3">Lihat Kartu Pendaftaran</span>
                </a>

                <a href="{{ route('password.change') }}" class="flex items-center px-6 py-3 transition-colors duration-200 {{ request()->routeIs('password.change') ? 'text-slate-200 bg-slate-900/50' : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <span class="mx-3">Ganti Password</span>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center px-6 py-3 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="mx-3">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex items-center justify-between p-4 bg-white border-b">
                <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 focus:outline-none lg:hidden">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
                        <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
                <div class="flex items-center">
                    <span class="text-sm font-medium">Selamat Datang, {{ strtok(Auth::user()->name, " ") }}!</span>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100 p-6">
                @yield('dashboard_content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

</html>