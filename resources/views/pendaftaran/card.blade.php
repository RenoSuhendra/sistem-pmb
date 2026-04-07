@extends('layouts.dashboard')

@section('title', 'Kartu Pendaftaran')

@section('dashboard_content')
    <div class="no-print mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-slate-800">Kartu Tanda Pendaftaran</h1>
        <div class="space-x-2">
            <button onclick="simpanPdf()" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md flex items-center text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Simpan PDF
            </button>
            <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md flex items-center text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Kartu
            </button>
        </div>
    </div>

    <!-- Area Kartu Pendaftaran (Desain Kertas A4) -->
    <div id="kartu-pendaftaran" class="printable-area bg-white mx-auto text-slate-800 relative">
        <!-- Watermark Latar Belakang (Opsional) -->
        <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none z-0 overflow-hidden">
            <h1 class="text-9xl font-extrabold transform -rotate-45 text-slate-900">PMB {{ date('Y') }}</h1>
        </div>

        <div class="relative z-10 p-8 border-4 border-double border-slate-800 h-full flex flex-col justify-between">
            
            <!-- 1. KOP SURAT (Compact) -->
            <header class="border-b-4 border-slate-800 pb-4 mb-4 flex items-center gap-4">
                <div class="flex-shrink-0">
                    <!-- Ganti src dengan logo asli Anda -->
                    <img src="{{ asset('storage/poto/LOGOSTIA.png') }}" alt="Logo" class="h-20 w-20 object-contain">
                </div>
                <div class="text-center flex-grow uppercase">
                    <h3 class="text-lg font-medium tracking-widest">Sekolah Tinggi Ilmu Administrasi Nusantara Sakti</h3>
                    <h1 class="text-3xl font-extrabold text-blue-900">STIA-NUSA SUNGAI PENUH</h1>
                    <p class="text-xs font-normal normal-case mt-1">Jl. Jend. Soedirman No.89 Sungai Penuh | Telp.Fax: (0748)22872 | www.stianusa.ac.id</p>
                </div>
            </header>

            <!-- 2. JUDUL & INFO UTAMA -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold underline decoration-2 underline-offset-4">KARTU TANDA PESERTA</h2>
                <p class="text-sm mt-1 font-mono">NO. REGISTRASI: <span class="bg-slate-200 px-2 py-0.5 rounded font-bold text-lg">{{ $pendaftaran->nomor_registrasi }}</span></p>
            </div>

            <!-- 3. KONTEN UTAMA (Layout Grid) -->
            <div class="flex flex-row gap-6 items-start">
                
                <!-- Kolom Kiri: Foto & QR -->
                <div class="w-1/4 flex flex-col items-center gap-4">
                    <div class="border-2 border-slate-800 p-1 bg-white shadow-sm">
                        <img src="{{ asset('storage/' . $pendaftaran->path_pas_foto) }}" alt="Pas Foto" class="w-32 h-40 object-cover">
                    </div>
                    <div class="text-center">
                        <div class="bg-white p-1 border border-slate-300 inline-block">
                            {!! QrCode::size(100)->generate($pendaftaran->nomor_registrasi) !!}
                        </div>
                        <p class="text-[10px] text-slate-500 mt-1">Scan untuk validasi</p>
                    </div>
                    <div class="w-full text-center mt-2 border-2 border-dashed border-slate-400 p-2 rounded">
                        <p class="text-xs text-slate-500 mb-1">Status Pendaftaran</p>
                        <p class="font-bold uppercase text-sm {{ $pendaftaran->status == 'Diverifikasi' ? 'text-green-700' : ($pendaftaran->status == 'Ditolak' ? 'text-red-700' : 'text-yellow-600') }}">
                            @if($pendaftaran->status == 'Pending')
                                BELUM DIVERIFIKASI
                            @else
                                {{ $pendaftaran->status }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Kolom Kanan: Detail Data -->
                <div class="w-3/4 space-y-4">
                    
                    <!-- A. Data Calon Mahasiswa -->
                    <div>
                        <h3 class="font-bold text-sm bg-slate-100 px-2 py-1 border-l-4 border-blue-800 mb-2">A. DATA CALON MAHASISWA</h3>
                        <table class="w-full text-sm">
                            <tr>
                                <td class="w-1/3 py-1 align-top text-slate-500">Nama Lengkap</td>
                                <td class="w-2/3 py-1 font-bold font-serif uppercase">: {{ $pendaftaran->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td class="py-1 align-top text-slate-500">NIK / NISN</td>
                                <td class="py-1">: {{ $pendaftaran->nik }} / {{ $pendaftaran->nisn }}</td>
                            </tr>
                            <tr>
                                <td class="py-1 align-top text-slate-500">TTL / Jenis Kelamin</td>
                                <td class="py-1">: {{ $pendaftaran->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d-m-Y') }} / {{ $pendaftaran->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td class="py-1 align-top text-slate-500">Asal Sekolah</td>
                                <td class="py-1">: {{ $pendaftaran->sekolah_asal }} (Lulus {{ $pendaftaran->tahun_lulus }})</td>
                            </tr>
                            <tr>
                                <td class="py-1 align-top text-slate-500">No. HP / WA</td>
                                <td class="py-1">: {{ $pendaftaran->nomor_hp }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- B. Data Orang Tua (Grid Compact) -->
                    <div>
                        <h3 class="font-bold text-sm bg-slate-100 px-2 py-1 border-l-4 border-blue-800 mb-2">B. DATA ORANG TUA</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <!-- Data Ayah -->
                            <div class="bg-slate-50 p-2 rounded border border-slate-200">
                                <p class="font-semibold text-xs text-slate-500 mb-1 uppercase">Data Ayah</p>
                                <table class="w-full text-xs">
                                    <tr><td class="w-20 text-slate-500">Nama</td><td>: {{ $pendaftaran->nama_ayah }}</td></tr>
                                    <tr><td class="text-slate-500">Pekerjaan</td><td>: {{ $pendaftaran->pekerjaan_ayah }}</td></tr>
                                </table>
                            </div>
                            <!-- Data Ibu -->
                            <div class="bg-slate-50 p-2 rounded border border-slate-200">
                                <p class="font-semibold text-xs text-slate-500 mb-1 uppercase">Data Ibu</p>
                                <table class="w-full text-xs">
                                    <tr><td class="w-20 text-slate-500">Nama</td><td>: {{ $pendaftaran->nama_ibu }}</td></tr>
                                    <tr><td class="text-slate-500">Pekerjaan</td><td>: {{ $pendaftaran->pekerjaan_ibu }}</td></tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- C. Pilihan Studi -->
                    <div>
                        <h3 class="font-bold text-sm bg-slate-100 px-2 py-1 border-l-4 border-blue-800 mb-2">C. PILIHAN STUDI</h3>
                        <table class="w-full text-sm">
                            <tr>
                                <td class="w-1/3 py-1 align-top text-slate-500">Program Studi</td>
                                <td class="w-2/3 py-1 font-bold text-blue-900">: {{ $pendaftaran->program_studi }}</td>
                            </tr>
                            <tr>
                                <td class="py-1 align-top text-slate-500">Lokal / Kelas</td>
                                <td class="py-1 font-bold">: {{ $pendaftaran->lokal_kuliah }}</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>

            <!-- 4. FOOTER & TANDA TANGAN -->
            <div class="mt-auto pt-8 flex justify-between items-end text-sm">
                <div class="text-xs text-slate-400 italic w-1/2">
                    <p>* Kartu ini adalah bukti pendaftaran yang sah.</p>
                    <p>* Harap dibawa saat melakukan verifikasi ulang atau ujian.</p>
                    <p>* Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
                </div>
                <div class="text-center w-1/3">
                    <p class="mb-16">{{ config('app.city', 'Sungai Penuh') }}, {{ now()->format('d F Y') }}</p>
                    <p class="font-bold border-b border-slate-800 inline-block min-w-[150px]">{{ $pendaftaran->nama_lengkap }}</p>
                    <p class="text-xs mt-1">Tanda Tangan Peserta</p>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Style khusus untuk tampilan layar (agar terlihat seperti kertas di layar) */
    #kartu-pendaftaran {
        width: 210mm; /* Lebar A4 */
        min-height: 297mm; /* Tinggi A4 */
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    /* Style khusus saat dicetak */
    @media print {
        @page {
            size: A4 portrait;
            margin: 0; /* Hilangkan margin browser */
        }
        body * {
            visibility: hidden; /* Sembunyikan semua elemen lain */
        }
        #kartu-pendaftaran, #kartu-pendaftaran * {
            visibility: visible; /* Tampilkan hanya kartu */
        }
        #kartu-pendaftaran {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 1cm; /* Margin kertas fisik */
            box-shadow: none;
            border: none;
            background: white;
        }
        /* Paksa background warna tercetak (untuk baris A, B, C) */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function simpanPdf() {
        const element = document.getElementById('kartu-pendaftaran');
        const opt = {
            margin:       0, // Margin diatur di CSS
            filename:     'Kartu-Pendaftaran-{{ $pendaftaran->nomor_registrasi }}.pdf',
            image:        { type: 'jpeg', quality: 1 },
            html2canvas:  { scale: 2, useCORS: true },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(element).save();
    }
</script>
@endpush