@extends('layouts.app')

@section('title', 'Formulir Pendaftaran Mahasiswa Baru')

@section('content')
<div class="mb-6 text-center">
    <h2 class="text-2xl font-bold text-gray-800">FORMULIR PENDAFTARAN MAHASISWA BARU</h2>
    <p class="text-md text-gray-600">Tahun Akademik {{ date('Y') }}/{{ date('Y') + 1 }}</p>
</div>

@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
    <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
    <ul class="mt-2 list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" x-data="{ lokal: '', biaya: 0 }">
    @csrf

    <!-- Data Calon Mahasiswa -->
    <div>
        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">A. DATA CALON MAHASISWA</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kolom Kiri -->
            <div class="space-y-4">
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required pattern="\d{16}" title="NIK harus 16 digit angka" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700">NISN (Nomor Induk Siswa Nasional)</label>
                    <input type="text" name="nisn" id="nisn" value="{{ old('nisn') }}" required pattern="\d{10}" title="NISN harus 10 digit angka" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email Aktif (untuk login)</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap (Sesuai KTP)</label>
                    <textarea name="alamat" id="alamat" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('alamat') }}</textarea>
                </div>
            </div>
            <!-- Kolom Kanan -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <div class="mt-2 space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <span class="ml-2">Laki-laki</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <span class="ml-2">Perempuan</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                    <select id="agama" name="agama" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="" disabled {{ old('agama') ? '' : 'selected' }}>Pilih Agama</option>
                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen Protestan" {{ old('agama') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                        <option value="Kristen Katolik" {{ old('agama') == 'Kristen Katolik' ? 'selected' : '' }}>Kristen Katolik</option>
                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>
                <div>
                    <label for="sekolah_asal" class="block text-sm font-medium text-gray-700">Sekolah Asal</label>
                    <input type="text" name="sekolah_asal" id="sekolah_asal" value="{{ old('sekolah_asal') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="tahun_lulus" class="block text-sm font-medium text-gray-700">Tahun Kelulusan</label>
                    <input type="number" name="tahun_lulus" id="tahun_lulus" value="{{ old('tahun_lulus') }}" required placeholder="Contoh: 2024" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="nomor_hp" class="block text-sm font-medium text-gray-700">Nomor Handphone/WA Aktif</label>
                    <input type="tel" name="nomor_hp" id="nomor_hp" value="{{ old('nomor_hp') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
            </div>
        </div>
    </div>

    <!-- --- PERUBAHAN: Form Data Orang Tua Detail --- -->
    <div>
        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">B. DATA ORANG TUA / WALI</h3>

        <!-- Data Ayah -->
        <div class="mt-6">
            <h4 class="text-md font-semibold text-gray-600 mb-4">Data Ayah</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="nama_ayah" class="block text-sm font-medium text-gray-700">Nama Lengkap Ayah</label>
                    <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="tanggal_lahir_ayah" class="block text-sm font-medium text-gray-700">Tanggal Lahir Ayah</label>
                    <input type="date" name="tanggal_lahir_ayah" id="tanggal_lahir_ayah" value="{{ old('tanggal_lahir_ayah') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="nik_ayah" class="block text-sm font-medium text-gray-700">NIK Ayah</label>
                    <input type="text" name="nik_ayah" id="nik_ayah" value="{{ old('nik_ayah') }}" required pattern="\d{16}" title="NIK harus 16 digit angka" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="pendidikan_ayah" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir Ayah</label>
                    <select name="pendidikan_ayah" id="pendidikan_ayah" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="" disabled selected>Pilih Pendidikan</option>
                        <option>SD/Sederajat</option>
                        <option>SMP/Sederajat</option>
                        <option>SMA/Sederajat</option>
                        <option>D1/D2/D3</option>
                        <option>S1/D4</option>
                        <option>S2</option>
                        <option>S3</option>
                    </select>
                </div>
                <div>
                    <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                    <select name="pekerjaan_ayah" id="pekerjaan_ayah" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="" disabled selected>Pilih Pekerjaan</option>
                        <option>Tidak Bekerja</option>
                        <option>PNS/TNI/POLRI</option>
                        <option>Karyawan Swasta</option>
                        <option>Wiraswasta</option>
                        <option>Petani/Nelayan</option>
                        <option>Lainnya</option>
                    </select>
                </div>
                <div>
                    <label for="penghasilan_ayah" class="block text-sm font-medium text-gray-700">Penghasilan Ayah</label>
                    <select name="penghasilan_ayah" id="penghasilan_ayah" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="" disabled selected>Pilih Penghasilan</option>
                        <option>&lt; Rp 1.000.000</option>
                        <option>Rp 1.000.000 - Rp 3.000.000</option>
                        <option>Rp 3.000.001 - Rp 5.000.000</option>
                        <option>&gt; Rp 5.000.000</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Data Ibu -->
        <div class="mt-8">
            <h4 class="text-md font-semibold text-gray-600 mb-4">Data Ibu</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Lengkap Ibu</label>
                    <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="tanggal_lahir_ibu" class="block text-sm font-medium text-gray-700">Tanggal Lahir Ibu</label>
                    <input type="date" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu" value="{{ old('tanggal_lahir_ibu') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="nik_ibu" class="block text-sm font-medium text-gray-700">NIK Ibu</label>
                    <input type="text" name="nik_ibu" id="nik_ibu" value="{{ old('nik_ibu') }}" required pattern="\d{16}" title="NIK harus 16 digit angka" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="pendidikan_ibu" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir Ibu</label>
                    <select name="pendidikan_ibu" id="pendidikan_ibu" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="" disabled selected>Pilih Pendidikan</option>
                        <option>Tidak Sekolah</option>
                        <option>SD/Sederajat</option>
                        <option>SMP/Sederajat</option>
                        <option>SMA/Sederajat</option>
                        <option>D1/D2/D3</option>
                        <option>S1/D4</option>
                        <option>S2</option>
                        <option>S3</option>
                    </select>
                </div>
                <div>
                    <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                    <select name="pekerjaan_ibu" id="pekerjaan_ibu" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="" disabled selected>Pilih Pekerjaan</option>
                        <option>Ibu Rumah Tangga</option>
                        <option>PNS/TNI/POLRI</option>
                        <option>Karyawan Swasta</option>
                        <option>Wiraswasta</option>
                        <option>Petani/Nelayan</option>
                        <option>Lainnya</option>
                    </select>
                </div>
                <div>
                    <label for="penghasilan_ibu" class="block text-sm font-medium text-gray-700">Penghasilan Ibu</label>
                    <select name="penghasilan_ibu" id="penghasilan_ibu" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="" disabled selected>Pilih Penghasilan</option>
                        <option>Tidak Berpenghasilan</option>
                        <option>&lt; Rp 1.000.000</option>
                        <option>Rp 1.000.000 - Rp 3.000.000</option>
                        <option>Rp 3.000.001 - Rp 5.000.000</option>
                        <option>&gt; Rp 5.000.000</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Pilihan Program Studi -->
    <div x-on:change="lokal = $event.target.value; if(lokal === 'Reguler') { biaya = 100000; } else if (lokal === 'Eksekutif' || lokal === 'Transfer/Pindahan') { biaya = 150000; } else { biaya = 0; }">
        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">C. PILIHAN PROGRAM STUDI</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="program_studi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                <select id="program_studi" name="program_studi" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="" disabled {{ old('program_studi') ? '' : 'selected' }}>Pilih Program Studi</option>
                    <option value="S1 Ilmu Administrasi Negara" {{ old('program_studi') == 'S1 Ilmu Administrasi Negara' ? 'selected' : '' }}>S1 Ilmu Administrasi Negara</option>
                    <option value="D3 Administrasi Perkantoran" {{ old('program_studi') == 'D3 Administrasi Perkantoran' ? 'selected' : '' }}>D3 Administrasi Perkantoran</option>
                </select>
            </div>
            <div>
                <label for="lokal_kuliah" class="block text-sm font-medium text-gray-700">Lokal Kuliah</label>
                <select id="lokal_kuliah" name="lokal_kuliah" x-model="lokal" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="" disabled selected>Pilih Lokal</option>
                    <option value="Reguler">Reguler</option>
                    <option value="Eksekutif">Eksekutif</option>
                    <option value="Transfer/Pindahan">Transfer/Pindahan</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Persyaratan -->
    <div>
        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">D. PERSYARATAN (Format: PDF, JPG, PNG | Max: 2MB)</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="kartu_keluarga" class="block text-sm font-medium text-gray-700">Kartu Keluarga</label>
                <input type="file" name="kartu_keluarga" id="kartu_keluarga" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
            <div>
                <label for="ijazah" class="block text-sm font-medium text-gray-700">Ijazah/SKL (Surat Ket. Lulus)</label>
                <input type="file" name="ijazah" id="ijazah" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
            <div>
                <label for="pas_foto" class="block text-sm font-medium text-gray-700">Pas Foto (3x4)</label>
                <input type="file" name="pas_foto" id="pas_foto" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
            <div>
                <label for="slip_pembayaran" class="block text-sm font-medium text-gray-700">Slip Pembayaran Uang Pendaftaran</label>
                <input type="file" name="slip_pembayaran" id="slip_pembayaran" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <div x-show="biaya > 0" class="mt-2 p-3 bg-blue-100 text-blue-800 rounded-md text-sm">
                    <p>Jumlah yang harus dibayar untuk lokal <b x-text="lokal"></b> adalah: <b x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(biaya)"></b></p>
                </div>
            </div>
        </div>
        
        <div x-show="lokal === 'Transfer/Pindahan'" x-transition class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
            <h4 class="text-md font-bold text-yellow-700 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Khusus Mahasiswa Pindahan
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="surat_pindah" class="block text-sm font-medium text-gray-700">Surat Pindah dari Universitas Asal <span class="text-red-500">*</span></label>
                    <input type="file" name="surat_pindah" id="surat_pindah" 
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-200 file:text-yellow-800 hover:file:bg-yellow-300">
                    <p class="text-xs text-gray-500 mt-1">Wajib diupload untuk jalur Transfer.</p>
                </div>
                <div>
                    <label for="transkrip_nilai" class="block text-sm font-medium text-gray-700">Transkrip Nilai Terakhir <span class="text-red-500">*</span></label>
                    <input type="file" name="transkrip_nilai" id="transkrip_nilai" 
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-200 file:text-yellow-800 hover:file:bg-yellow-300">
                    <p class="text-xs text-gray-500 mt-1">Wajib diupload untuk jalur Transfer.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Konfirmasi -->
    <div>
        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">E. KONFIRMASI</h3>
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="konfirmasi" name="konfirmasi" type="checkbox" required value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
            </div>
            <div class="ml-3 text-sm">
                <label for="konfirmasi" class="font-medium text-gray-700">Saya menyatakan bahwa data yang saya isikan adalah benar dan dapat dipertanggungjawabkan. Saya bersedia menerima sanksi apabila data yang saya isikan tidak benar.</label>
            </div>
        </div>
    </div>

    <div class="pt-5">
        <div class="flex justify-end">
            <button type="submit" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-transform transform hover:scale-105">
                Daftar Sekarang
            </button>
        </div>
    </div>
</form>
@endsection