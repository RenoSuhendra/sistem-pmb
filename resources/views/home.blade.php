{{-- File: resources/views/home.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Dasbor Utama Mahasiswa')

@section('dashboard_content')
<!-- Kop Halaman -->
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <div class="flex items-center space-x-4 pb-4 border-b-2 border-slate-200">
        <img src="{{ asset('storage/poto/LOGOSTIA.png') }}" alt="Logo Kampus" class="h-20 w-20 object-contain">
        <div class="flex-grow">
            <h2 class="text-2xl font-extrabold text-blue-800">SEKOLAH TINGGI ILMU ADMINSTRASI NUSANTARA <br>(STIA-NUSA) SUNGAI PENUH</h2>
            <p class="text-sm text-slate-600">Portal Calon Mahasiswa Tahun Akademik 2025/2026</p>
        </div>
    </div>
</div>

<!-- Pesan Selamat Datang -->
<div class="bg-blue-600 text-white rounded-lg shadow-lg p-8 mb-8">
    <h2 class="text-3xl font-bold">Anda Telah Login!</h2>
    <p class="mt-2 text-blue-200">Selamat datang di dasbor pribadi Anda. Di sini Anda dapat melihat status pendaftaran dan informasi penting lainnya.</p>
</div>

<!-- Informasi Pendaftaran -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-bold border-b pb-2 mb-4">Informasi Pendaftaran Anda</h3>
        <div class="space-y-4">
            <div>
                <p class="text-sm text-slate-500">Nomor Registrasi</p>
                <p class="font-semibold text-lg">{{ Auth::user()->pendaftaran->nomor_registrasi ?? 'Data tidak ditemukan' }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Program Studi Pilihan</p>
                <p class="font-semibold text-lg">{{ Auth::user()->pendaftaran->program_studi ?? 'Data tidak ditemukan' }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Lokal Kuliah Pilihan</p>
                <p class="font-semibold text-lg">{{ Auth::user()->pendaftaran->lokal_kuliah ?? 'Data tidak ditemukan' }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center justify-center text-center">
        <h3 class="text-lg font-bold mb-2">Status Verifikasi</h3>
        @if(Auth::user()->pendaftaran)
        @php
        $status = Auth::user()->pendaftaran->status;
        $statusInfo = [
        'Pending' => ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'yellow', 'text' => 'Berkas Anda sedang dalam proses peninjauan.'],
        'Diverifikasi' => ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'green', 'text' => 'Selamat! Pendaftaran Anda telah diverifikasi.'],
        'Ditolak' => ['icon' => 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636', 'color' => 'red', 'text' => 'Mohon maaf, pendaftaran Anda ditolak.'],
        ];
        @endphp
        <div class="w-24 h-24 rounded-full bg-{{ $statusInfo[$status]['color'] }}-100 flex items-center justify-center mb-4">
            <svg class="w-12 h-12 text-{{ $statusInfo[$status]['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $statusInfo[$status]['icon'] }}"></path>
            </svg>
        </div>
        <span class="px-4 py-2 text-sm font-bold text-{{ $statusInfo[$status]['color'] }}-800 bg-{{ $statusInfo[$status]['color'] }}-200 rounded-full">{{ $status }}</span>
        <p class="text-sm text-slate-500 mt-3">{{ $statusInfo[$status]['text'] }}</p>
        @else
        <p class="text-sm text-slate-500">Status tidak tersedia.</p>
        @endif
    </div>
</div>
@endsection