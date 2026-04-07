@extends('layouts.admin')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.pendaftar.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:underline">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Daftar Mahasiswa
    </a>
</div>

<h1 class="text-3xl font-bold text-slate-800 mb-2">Detail & Verifikasi Pendaftar</h1>
<p class="text-slate-500 mb-6">No. Registrasi: <span class="font-mono">{{ $pendaftar->nomor_registrasi }}</span></p>

@if(session('success'))
<div class="bg-green-100 border-green-500 text-green-700 border-l-4 p-4 mb-6" role="alert">
    <p class="font-bold">Sukses!</p>
    <p>{{ session('success') }}</p>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Kolom Data Lengkap Mahasiswa -->
    <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-bold border-b border-slate-200 pb-3 mb-4">Data Lengkap Pendaftar</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 text-sm">
            <div>
                <strong class="block text-slate-500 font-medium">Nama Lengkap</strong>
                <p class="text-slate-800">{{ $pendaftar->nama_lengkap }}</p>
            </div>
            <div>
                <strong class="block text-slate-500 font-medium">Jenis Kelamin</strong>
                <p class="text-slate-800">{{ $pendaftar->jenis_kelamin }}</p>
            </div>
            <div>
                <strong class="block text-slate-500 font-medium">NIK</strong>
                <p class="text-slate-800">{{ $pendaftar->nik }}</p>
            </div>
            <div>
                <strong class="block text-slate-500 font-medium">NISN</strong>
                <p class="text-slate-800">{{ $pendaftar->nisn }}</p>
            </div>
            <div>
                <strong class="block text-slate-500 font-medium">Tempat, Tanggal Lahir</strong>
                <p class="text-slate-800">{{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</p>
            </div>
            <div>
                <strong class="block text-slate-500 font-medium">Agama</strong>
                <p class="text-slate-800">{{ $pendaftar->agama }}</p>
            </div>
            <div>
                <strong class="block text-slate-500 font-medium">Asal Sekolah</strong>
                <p class="text-slate-800">{{ $pendaftar->sekolah_asal }}</p>
            </div>
            <div>
                <strong class="block text-slate-500 font-medium">Tahun Lulus</strong>
                <p class="text-slate-800">{{ $pendaftar->tahun_lulus }}</p>
            </div>
            <div>
                <strong class="block text-slate-500 font-medium">Email</strong>
                <p class="text-slate-800">{{ $pendaftar->email }}</p>
            </div>
            <div>
                <strong class="block text-slate-500 font-medium">No. Handphone</strong>
                <p class="text-slate-800">{{ $pendaftar->nomor_hp }}</p>
            </div>
            <div class="md:col-span-2">
                <strong class="block text-slate-500 font-medium">Alamat Lengkap</strong>
                <p class="text-slate-800">{{ $pendaftar->alamat }}</p>
            </div>

            <hr class="md:col-span-2 my-2 border-slate-200">

            <div>
                <strong class="block text-slate-500 font-medium">Nama Orang Tua/Wali</strong>
                <p class="text-slate-800">{{ $pendaftar->nama_orang_tua }}</p>
            </div>
            <div>
                <strong class="block text-slate-500 font-medium">Pekerjaan Orang Tua/Wali</strong>
                <p class="text-slate-800">{{ $pendaftar->pekerjaan_orang_tua }}</p>
            </div>

            <hr class="md:col-span-2 my-2 border-slate-200">

            <div>
                <strong class="block text-slate-500 font-medium">Program Studi Pilihan</strong>
                <p class="text-slate-800 font-semibold">{{ $pendaftar->program_studi }}</p>
            </div>
            <div>
                <strong class="block text-slate-500 font-medium">Lokal Kuliah Pilihan</strong>
                <p class="text-slate-800 font-semibold">{{ $pendaftar->lokal_kuliah }}</p>
            </div>
        </div>
    </div>

    <!-- Kolom Aksi (Verifikasi & Berkas) -->
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-bold border-b border-slate-200 pb-3 mb-4">Verifikasi Status</h3>
            <form action="{{ route('admin.pendaftar.updateStatus', $pendaftar) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="status" class="block text-sm font-medium text-slate-700">Ubah Status Pendaftaran</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="Pending" @selected($pendaftar->status == 'Pending')>Pending</option>
                    <option value="Diverifikasi" @selected($pendaftar->status == 'Diverifikasi')>Diverifikasi</option>
                    <option value="Ditolak" @selected($pendaftar->status == 'Ditolak')>Ditolak</option>
                </select>
                <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 font-semibold transition-colors">Simpan Status</button>
            </form>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-bold border-b border-slate-200 pb-3 mb-4">Berkas Terlampir</h3>
            <div class="space-y-3">
                <a href="{{ asset('storage/' . $pendaftar->path_pas_foto) }}" target="_blank" class="flex items-center text-blue-600 hover:underline">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Lihat Pas Foto
                </a>
                <a href="{{ asset('storage/' . $pendaftar->path_kartu_keluarga) }}" target="_blank" class="flex items-center text-blue-600 hover:underline">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"></path>
                    </svg>
                    Lihat Kartu Keluarga
                </a>
                <a href="{{ asset('storage/' . $pendaftar->path_ijazah) }}" target="_blank" class="flex items-center text-blue-600 hover:underline">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Lihat Ijazah/SKL
                </a>
                <a href="{{ asset('storage/' . $pendaftar->path_slip_pembayaran) }}" target="_blank" class="flex items-center text-blue-600 hover:underline">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Lihat Slip Pembayaran
                </a>
            </div>
        </div>
    </div>
</div>
@endsection