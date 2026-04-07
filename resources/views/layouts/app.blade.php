<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pendaftaran Mahasiswa Baru')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('storage/poto/LOGOSTIA.png') }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .kop-surat {
            border-bottom: 4px double #000;
        }

        .kop-surat img {
            height: 90px;
        }
    </style>
    <!-- Tambahkan Alpine.js untuk interaktivitas -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="bg-blue p-6 rounded-t-lg shadow-md">
            <div class="kop-surat flex items-center space-x-4 pb-4">
                <img src="{{ asset('storage/poto/LOGOSTIA.png') }}" alt="Logo Kampus" class="h-24 w-24 object-contain">
                <div class="text-center flex-grow">
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">SEKOLAH TINGGI ILMU ADMINISTRASI NUSANTARA SAKTI</h1>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-blue-800">(STIA-NUSA) SUNGAI PENUH</h2>
                    <p class="text-sm text-gray-600">SK. MENDIKNAS RI No.62/D/O/2005</p>
                    <p class="text-sm text-gray-600">STATUS : TERAKREDITASI</p>
                    <p class="text-sm text-gray-600">Jl. Jend. Soedirman No.89 Sungai Penuh www.stianusa.ac.id Telp.fax.(0748)22872</p>
                </div>
            </div>
        </header>

        <main class="bg-blue p-6 rounded-b-lg shadow-md">
            @yield('content')
        </main>

        <footer class="text-center mt-8 text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} Sekolah Tinggi Ilmu Administrasi Nusantara Sakti (STIA-NUSA) Sungai Penuh. All rights reserved.</p>
        </footer>
    </div>

</body>

</html>