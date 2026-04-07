<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_registrasi')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // Data Diri
            $table->string('nama_lengkap');
            $table->string('nik', 16)->unique();
            $table->string('nisn', 10)->unique();
            $table->string('email')->unique(); // Penting untuk login
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->year('tahun_lulus');
            $table->string('sekolah_asal');
            $table->string('agama');
            $table->text('alamat');
            $table->string('nomor_hp');

            // --- PERUBAHAN: Data Orang Tua dibuat lebih detail ---
            // Data Ayah
            $table->string('nama_ayah');
            $table->date('tanggal_lahir_ayah');
            $table->string('nik_ayah', 16);
            $table->string('pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');

            // Data Ibu
            $table->string('nama_ibu');
            $table->date('tanggal_lahir_ibu');
            $table->string('nik_ibu', 16);
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('penghasilan_ibu');

            // Pilihan Kampus
            $table->string('program_studi');
            $table->string('lokal_kuliah');

            // Upload Berkas (menyimpan path file)
            $table->string('path_kartu_keluarga');
            $table->string('path_ijazah');
            $table->string('path_pas_foto');
            $table->string('path_slip_pembayaran');
            $table->string('path_surat_pindah')->nullable();
            $table->string('path_transkrip_nilai')->nullable();

            // Status Pendaftaran
            $table->enum('status', ['Pending', 'Diverifikasi', 'Ditolak'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
