<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PimpinanOrganisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pimpinan_nama',
        'pimpinan_email',
        'pimpinan_tgl_awal',
        'pimpinan_tgl_akhir',
        'pimpinan_sk',
        'pimpinan_sk_dokumen',
        'pimpinan_status',
        'created_at',
        'updated_at',
        'id_jabatan',
        'id_organization',
        'pimpinan_status'
    ];
}
