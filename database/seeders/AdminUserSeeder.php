<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada untuk mencegah duplikasi
        if (User::where('email', 'admin@stianusa.ac.id')->doesntExist()) {

            // "Membangun Rumah": Membuat satu baris data baru di tabel 'users'
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@stianusa.ac.id',
                'role' => 'admin', // Ini adalah peran yang sangat penting
                'password' => Hash::make('PasswordAdmin123!'), // Ini adalah password yang di-hash
                'email_verified_at' => now(), // Anggap email sudah terverifikasi
            ]);
        }
    }
}
