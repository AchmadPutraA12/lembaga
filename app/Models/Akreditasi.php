<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akreditasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'akreditasi_sk',
        'akreditasi_tgl_awal',
        'akreditasi_tgl_akhir',
        'akreditasi_status',
        'id_peringkat_akreditasi',
        'id_organization',
        'id_lembaga_akreditasi',
        'id_user',
        'id_prodi',
        'akreditasi_dokumen'
    ];

}
