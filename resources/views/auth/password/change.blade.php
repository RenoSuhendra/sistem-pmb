{{--
    File: resources/views/auth/passwords/change.blade.php
    Tampilan ini akan di-extend dari layout dasbor utama.
--}}

@extends('layouts.app') {{-- Ganti dengan nama layout dasbor Anda jika berbeda --}}

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold text-slate-800 mb-4">Ganti Password</h1>

    <div class="bg-white p-6 md:p-8 rounded-lg shadow-md max-w-2xl mx-auto">
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Pesan Sukses -->
            @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            <!-- Pesan Error -->
            @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Oops! Terjadi kesalahan.</p>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="list-disc list-inside">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="space-y-6">
                <!-- Password Saat Ini -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-slate-700">Password Saat Ini</label>
                    <input type="password" name="current_password" id="current_password" required
                        class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>

                <!-- Password Baru -->
                <div>
                    <label for="new_password" class="block text-sm font-medium text-slate-700">Password Baru</label>
                    <input type="password" name="new_password" id="new_password" required
                        class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <p class="mt-2 text-xs text-slate-500">Minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol.</p>
                </div>

                <!-- Konfirmasi Password Baru -->
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-slate-700">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                        class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8 border-t pt-6">
                <a href="{{ route('home') }}"
                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-3 px-4 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-colors duration-200">
                    Kembali
                </a>
                <button type="submit"
                    class="w-30 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Ubah Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

{{-- Catatan: Ganti @extends('layouts.app_dashboard') dengan layout yang sesuai.
Jika Anda menggunakan layout yang sama dengan form pendaftaran, mungkin namanya @extends('layouts.app').
Namun, untuk dasbor, biasanya lebih baik menggunakan layout terpisah.
Untuk sementara, saya akan asumsikan Anda membuat file baru `layouts/app_dashboard.blade.php`
yang isinya adalah struktur dasbor dari `home.blade.php` tanpa bagian kontennya. --}}