<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akta extends Model
{
    use HasFactory;

    protected $fillable = [
        'akta_nomor',
        'akta_tgl_awal',
        'akta_tgl_akhir',
        'akta_nama_notaris',
        'akta_kota_notaris',
        'akta_status', 
        'akta_jenis', 
        'akta_dokumen',
        'id_user',
        'akta_defined_id',
        'id_organization',
        'id_prodi'
    ];
}
