@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil')

@section('content')
<div class="text-center py-10 px-4 sm:px-6 lg:px-8">
    <div class="no-print">
        <svg class="mx-auto h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h2 class="mt-4 text-2xl font-bold text-gray-800">PENDAFTARAN BERHASIL!</h2>
        <p class="mt-2 text-md text-gray-600">
            Selamat, <b>{{ $pendaftaran->nama_lengkap }}</b>! Anda telah berhasil melakukan pendaftaran awal.
        </p>
        <p class="mt-1 text-gray-600">Silakan simpan kartu pendaftaran di bawah ini sebagai bukti.</p>
        <p class="mt-1 text-gray-600">Informasi selanjutnya mengenai status verifikasi akan diumumkan melalui dashboard Anda.</p>
    </div>

    <!-- Kartu Tanda Pendaftaran -->
    <div id="kartu-pendaftaran" class="printable-area mt-8 max-w-2xl mx-auto bg-white border border-gray-200 rounded-lg shadow-lg p-6 text-left">
        <h3 class="text-xl font-bold text-center text-gray-800 border-b pb-3 mb-4">KARTU TANDA BUKTI PENDAFTARAN</h3>
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Kiri: Foto, No Reg, QR -->
            <div class="flex-shrink-0 w-full md:w-1/3 text-center">
                <img src="{{ asset('storage/' . $pendaftaran->path_pas_foto) }}" alt="Pas Foto" class="w-32 h-40 object-cover mx-auto rounded-md border-2 border-gray-300">
                <div class="mt-4">
                    <p class="text-sm font-semibold text-gray-500">Nomor Registrasi:</p>
                    <p class="text-lg font-bold text-indigo-600 tracking-wider">{{ $pendaftaran->nomor_registrasi }}</p>
                </div>
                <div class="mt-4">
                    {!! QrCode::size(120)->generate($pendaftaran->nomor_registrasi) !!}
                    <p class="text-xs text-gray-500 mt-1">Scan untuk verifikasi</p>
                </div>
            </div>

            <!-- Kanan: Status & Data -->
            <div class="flex-grow">
                <div class="mb-4">
                    <p class="text-sm font-semibold text-gray-500">Status Pendaftaran:</p>
                    <p class="text-lg font-bold 
                        @if($pendaftaran->status == 'Pending') text-yellow-500 @endif
                        @if($pendaftaran->status == 'Diverifikasi') text-green-500 @endif
                        @if($pendaftaran->status == 'Ditolak') text-red-500 @endif
                    ">
                        {{ $pendaftaran->status }}
                    </p>
                </div>

                <div class="space-y-3 text-sm">
                    <div class="flex">
                        <p class="w-1/3 font-semibold text-gray-500">Nama Lengkap</p>
                        <p class="w-2/3 text-gray-800">: {{ $pendaftaran->nama_lengkap }}</p>
                    </div>
                    <div class="flex">
                        <p class="w-1/3 font-semibold text-gray-500">NIK</p>
                        <p class="w-2/3 text-gray-800">: {{ $pendaftaran->nik }}</p>
                    </div>
                    <div class="flex">
                        <p class="w-1/3 font-semibold text-gray-500">Asal Sekolah</p>
                        <p class="w-2/3 text-gray-800">: {{ $pendaftaran->sekolah_asal }}</p>
                    </div>
                    <!-- --- PERUBAHAN: Menampilkan data orang tua --- -->
                    <div class="pt-2 mt-2 border-t">
                        <div class="flex">
                            <p class="w-1/3 font-semibold text-gray-500">Nama Ayah</p>
                            <p class="w-2/3 text-gray-800">: {{ $pendaftaran->nama_ayah }}</p>
                        </div>
                        <div class="flex">
                            <p class="w-1/3 font-semibold text-gray-500">Pekerjaan Ayah</p>
                            <p class="w-2/3 text-gray-800">: {{ $pendaftaran->pekerjaan_ayah }}</p>
                        </div>
                    </div>
                    <div class="pt-2 mt-2 border-t">
                        <div class="flex">
                            <p class="w-1/3 font-semibold text-gray-500">Nama Ibu</p>
                            <p class="w-2/3 text-gray-800">: {{ $pendaftaran->nama_ibu }}</p>
                        </div>
                        <div class="flex">
                            <p class="w-1/3 font-semibold text-gray-500">Pekerjaan Ibu</p>
                            <p class="w-2/3 text-gray-800">: {{ $pendaftaran->pekerjaan_ibu }}</p>
                        </div>
                    </div>
                    <!-- --- Akhir Perubahan --- -->
                    <div class="flex pt-2 mt-2 border-t">
                        <p class="w-1/3 font-semibold text-gray-500">Program Studi</p>
                        <p class="w-2/3 text-gray-800 font-bold">: {{ $pendaftaran->program_studi }}</p>
                    </div>
                    <div class="flex">
                        <p class="w-1/3 font-semibold text-gray-500">Lokal Kuliah</p>
                        <p class="w-2/3 text-gray-800 font-bold">: {{ $pendaftaran->lokal_kuliah }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-8 space-y-4 md:space-y-0 md:space-x-4 no-print">
        <button onclick="simpanPdf()" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg">
            Simpan sebagai PDF
        </button>
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg">
            Cetak Kartu
        </button>
    </div>

    <div class="mt-8 no-print">
        <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg">
            Lanjut ke Halaman Login
        </a>
        <p class="mt-4 text-sm text-gray-600">
            Gunakan <b>email</b> Anda dan <b>Nomor Registrasi</b> sebagai password untuk login pertama kali.
        </p>
    </div>
</div>
@endsection

@push('scripts')
<!-- Library untuk generate PDF dari HTML -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function simpanPdf() {
        const element = document.getElementById('kartu-pendaftaran');
        const opt = {
            margin: 0.5,
            filename: 'kartu-pendaftaran-{{ $pendaftaran->nomor_registrasi }}.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2,
                useCORS: true
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };
        html2pdf().set(opt).from(element).save();
    }
</script>
@endpush