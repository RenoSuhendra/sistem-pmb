<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    /**
     * Tampilkan halaman form ganti password.
     * Hanya bisa diakses oleh user yang sudah login.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan view untuk form ganti password.
     */
    public function create()
    {
        return view('auth.password.change');
    }

    /**
     * Memproses permintaan untuk mengubah password.
     */
    public function update(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'new_password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ], [
            'current_password.current_password' => 'Password saat ini yang Anda masukkan salah.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        // 2. Jika validasi berhasil, update password user
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        // 3. Redirect kembali dengan pesan sukses
        return back()->with('success', 'Password Anda telah berhasil diubah!');
    }
}
