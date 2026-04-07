<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dasbor') - PMB STIANUSA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-slate-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-slate-100 text-slate-800">
        <!-- Sidebar -->
        <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="fixed inset-y-0 left-0 z-30 w-64 transform bg-slate-900 text-white transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0">
            <div class="flex items-center justify-center px-4 py-6"><span class="text-2xl font-extrabold text-white">ADMIN PMB</span></div>
            <nav class="mt-4 text-sm font-medium">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'text-white bg-slate-800' : 'text-slate-400 hover:bg-slate-800/50' }}"><span class="mx-3">Dashboard Utama</span></a>
                <a href="{{ route('admin.pendaftar.index') }}" class="flex items-center px-6 py-3 transition-colors duration-200 {{ request()->routeIs('admin.pendaftar.*') ? 'text-white bg-slate-800' : 'text-slate-400 hover:bg-slate-800/50' }}"><span class="mx-3">Data Mahasiswa</span></a>
                <a href="{{ route('admin.qr.scanner') }}" class="flex items-center px-6 py-3 transition-colors duration-200 {{ request()->routeIs('admin.qr.scanner') ? 'text-white bg-slate-800' : 'text-slate-400 hover:bg-slate-800/50' }}"><span class="mx-3">Verifikasi QR</span></a>
                <a href="{{ route('admin.password.change') }}" class="flex items-center px-6 py-3 transition-colors duration-200 {{ request()->routeIs('admin.password.change') ? 'text-white bg-slate-800' : 'text-slate-400 hover:bg-slate-800/50' }}"><span class="mx-3">Ganti Password</span></a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center px-6 py-3 text-slate-400 hover:bg-slate-800/50"><span class="mx-3">Logout</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </nav>
        </aside>
        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex items-center justify-between p-4 bg-white border-b shadow-sm">
                <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 focus:outline-none lg:hidden"><svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></button>
                <div class="flex items-center"><span class="text-sm font-medium">Selamat Datang, {{ Auth::user()->name }}</span></div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100 p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

</html>