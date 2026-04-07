<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_registrasi',
        'user_id',
        'nama_lengkap',
        'nik',
        'nisn',
        'email',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'tahun_lulus',
        'sekolah_asal',
        'agama',
        'alamat',
        'nomor_hp',

        // --- PERUBAHAN: Update field orang tua ---
        'nama_ayah',
        'tanggal_lahir_ayah',
        'nik_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nama_ibu',
        'tanggal_lahir_ibu',
        'nik_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',

        'program_studi',
        'lokal_kuliah',
        'path_kartu_keluarga',
        'path_ijazah',
        'path_pas_foto',
        'path_slip_pembayaran',
        'path_surat_pindah',
        'path_transkrip_nilai',
        'status',
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
