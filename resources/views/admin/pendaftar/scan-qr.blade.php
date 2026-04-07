@extends('layouts.admin')

@section('title', 'Verifikasi QR')

@section('content')
<h1 class="text-3xl font-bold text-slate-800 mb-6">Verifikasi Kartu Pendaftaran via QR</h1>

<div class="bg-white p-6 rounded-lg shadow-md max-w-xl mx-auto">
    <!-- Pesan Error jika pendaftar tidak ditemukan -->
    @if(session('error'))
    <div class="bg-red-100 border-red-500 text-red-700 border-l-4 p-4 mb-6" role="alert">
        <p class="font-bold">Gagal!</p>
        <p>{{ session('error') }}</p>
    </div>
    @endif

    <!-- Area untuk Scanner -->
    <div id="qr-reader" class="w-full border-2 border-dashed border-slate-300 rounded-lg overflow-hidden bg-slate-50"></div>

    <div class="text-center mt-4 text-sm text-slate-500">
        <p>Arahkan kamera ke Kode QR pada kartu pendaftaran mahasiswa.</p>
        <p>Sistem akan otomatis mengarahkan Anda ke halaman detail.</p>
    </div>
</div>

<!-- Library untuk QR Scanner -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    function onScanSuccess(decodedText, decodedResult) {
        // `decodedText` berisi data dari QR code (yaitu nomor registrasi)
        console.log(`Scan result: ${decodedText}`, decodedResult);

        // Hentikan scanner setelah berhasil
        html5QrcodeScanner.clear();

        // Tampilkan pesan loading/redirect
        document.getElementById('qr-reader').innerHTML = `
                <div class="p-12 text-center">
                    <p class="font-bold text-lg text-green-600">Kode QR Terdeteksi!</p>
                    <p class="text-slate-600 mt-2">Nomor Registrasi: <span class="font-mono">${decodedText}</span></p>
                    <p class="text-slate-500 mt-4 animate-pulse">Mengarahkan ke halaman verifikasi...</p>
                </div>
            `;

        // Redirect ke halaman verifikasi berdasarkan nomor registrasi yang didapat
        window.location.href = `/admin/pendaftar/by-reg/${decodedText}`;
    }

    function onScanFailure(error) {
        // Tidak perlu melakukan apa-apa saat gagal, scanner akan terus mencoba
    }

    // Inisialisasi scanner
    let html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", {
            // PENINGKATAN: Menaikkan FPS dari 10 menjadi 30 untuk pemindaian lebih cepat
            fps: 30,
            // PENINGKATAN: Membuat ukuran qrbox responsif agar lebih optimal di berbagai perangkat
            qrbox: (viewfinderWidth, viewfinderHeight) => {
                const minEdge = Math.min(viewfinderWidth, viewfinderHeight);
                const qrboxSize = Math.floor(minEdge * 0.7);
                return {
                    width: qrboxSize,
                    height: qrboxSize
                };
            }
        },
        /* verbose= */
        false);

    // Mulai memindai
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
@endsection