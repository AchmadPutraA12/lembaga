<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;
    protected $fillable = [
        'prodi_kode',
        'prodi_defined_id',
        'prodi_nama',
        'prodi_jenjang',
        'created_at',
        'updated_at',
        'prodi_active_status',
        'id_organization',
        'id_user'
    ];
}
