<?php

use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ChangePasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\AdminPasswordController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('contohdashboard');
});
// Halaman utama bisa langsung ke form pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.form');

// Rute untuk pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaran/sukses/{nomor_registrasi}', [PendaftaranController::class, 'sukses'])->name('pendaftaran.sukses');

// Laravel Fortify/UI akan menangani rute login, register (default), dll.
// Kita akan buat rute login manual untuk kejelasan
Route::get('/login', function () {
    return view('auth.login');
})->name('login');



// ... rute lain

// GRUP RUTE UNTUK ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dasbor
    Route::get('/dashboard', [AdminPendaftaranController::class, 'dashboard'])->name('dashboard');

    // CRUD Mahasiswa
    Route::resource('pendaftar', AdminPendaftaranController::class)->except(['create', 'store', 'edit']);
    Route::put('/pendaftar/{pendaftar}/update-status', [AdminPendaftaranController::class, 'updateStatus'])->name('pendaftar.updateStatus');

    // Verifikasi QR
    Route::get('/verifikasi-qr', [AdminPendaftaranController::class, 'showQrScanner'])->name('qr.scanner');
    Route::get('/pendaftar/by-reg/{nomor_registrasi}', [AdminPendaftaranController::class, 'showByReg'])->name('pendaftar.showByReg');

    // Ganti Password Admin
    Route::get('/ganti-password', [AdminPasswordController::class, 'create'])->name('password.change');
    Route::put('/ganti-password', [AdminPasswordController::class, 'update'])->name('password.update');
});


// Setelah login, user akan diarahkan ke /home
Route::get('/home', function () {
    // Di sini nanti halaman dashboard mahasiswa
    return 'Selamat datang di Dashboard Anda!';
})->middleware('auth')->name('home');

// Tambahkan rute otentikasi default dari Laravel
Auth::routes(['register' => false]); // Matikan rute register default

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// ... rute lain

// Rute untuk Ganti Password (Harus dalam keadaan login)
Route::middleware('auth')->group(function () {
    Route::get('/ganti-password', [ChangePasswordController::class, 'create'])->name('password.change');
    Route::put('/ganti-password', [ChangePasswordController::class, 'update'])->name('password.update');
    Route::get('/kartu-pendaftaran', [PendaftaranController::class, 'showCard'])->name('pendaftaran.card');
});
