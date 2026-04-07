<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // Pastikan ini ada

class PendaftaranController extends Controller
{
    // Menampilkan halaman formulir pendaftaran
    public function create()
    {
        return view('pendaftaran.form');
    }

    // Menyimpan data pendaftaran
    public function store(Request $request)
    {
        // 1. Validasi data
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:pendaftarans,nik',
            'nisn' => 'required|string|size:10|unique:pendaftarans,nisn',
            'email' => 'required|email|unique:pendaftarans,email|unique:users,email',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_lulus' => 'required|digits:4|integer|min:2000',
            'sekolah_asal' => 'required|string|max:255',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string|max:15',

            'nama_ayah' => 'required|string|max:255',
            'tanggal_lahir_ayah' => 'required|date',
            'nik_ayah' => 'required|string|size:16',
            'pendidikan_ayah' => 'required|string',
            'pekerjaan_ayah' => 'required|string',
            'penghasilan_ayah' => 'required|string',
            'nama_ibu' => 'required|string|max:255',
            'tanggal_lahir_ibu' => 'required|date',
            'nik_ibu' => 'required|string|size:16',
            'pendidikan_ibu' => 'required|string',
            'pekerjaan_ibu' => 'required|string',
            'penghasilan_ibu' => 'required|string',

            'program_studi' => 'required|string',
            'lokal_kuliah' => 'required|string',
            'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pas_foto' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'slip_pembayaran' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_pindah' => 'required_if:lokal_kuliah,Transfer/Pindahan|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'transkrip_nilai' => 'required_if:lokal_kuliah,Transfer/Pindahan|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'konfirmasi' => 'required|accepted',
        ]);

        // 2. Generate Nomor Registrasi Unik
        // Format: PMB-YYYYMMDD-XXXXXX
        $nomor_registrasi = 'PMB-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

        // 3. Upload file dan simpan path-nya
        // PERBAIKAN: Menggunakan disk 'public' secara eksplisit agar path benar
        $paths = [];
        $filesToUpload = ['kartu_keluarga', 'ijazah', 'pas_foto', 'slip_pembayaran', 'surat_pindah', 'transkrip_nilai'];
        foreach ($filesToUpload as $file) {
            if ($request->hasFile($file)) {
                // Menyimpan ke 'storage/app/public/dokumen_pendaftaran/...'
                // dan $path akan berisi 'dokumen_pendaftaran/...'
                $path = $request->file($file)->store('dokumen_pendaftaran/' . $nomor_registrasi, 'public');
                $paths['path_' . $file] = $path;
            }
        }

        // 4. Buat Akun User Baru untuk Login
        $user = User::create([
            'name' => $validatedData['nama_lengkap'],
            'email' => $validatedData['email'],
            'password' => Hash::make($nomor_registrasi), // Sandi default adalah nomor registrasi
        ]);

        // 5. Simpan semua data ke tabel pendaftarans
        $pendaftaran = Pendaftaran::create(array_merge(
            $validatedData,
            $paths,
            [
                'nomor_registrasi' => $nomor_registrasi,
                'user_id' => $user->id,
            ]
        ));

        // 6. Redirect ke halaman sukses
        return redirect()->route('pendaftaran.sukses', ['nomor_registrasi' => $nomor_registrasi]);
    }

    // Menampilkan halaman sukses
    public function sukses($nomor_registrasi)
    {
        $pendaftaran = Pendaftaran::where('nomor_registrasi', $nomor_registrasi)->firstOrFail();
        return view('pendaftaran.sukses', compact('pendaftaran'));
    }

    public function showCard()
    {
        // Ambil data pendaftaran yang terhubung dengan user yang sedang login
        $pendaftaran = Auth::user()->pendaftaran;

        // Jika data tidak ditemukan, kembali ke home dengan pesan error
        if (!$pendaftaran) {
            return redirect()->route('home')->with('error', 'Data pendaftaran Anda tidak ditemukan.');
        }

        // Tampilkan view kartu pendaftaran dengan data yang relevan
        return view('pendaftaran.card', compact('pendaftaran'));
    }
}
