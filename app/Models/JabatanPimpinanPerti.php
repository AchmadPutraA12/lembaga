<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanPimpinanPerti extends Model
{
    use HasFactory;

    protected $fillable = [
        'jabatan_nama',
        'jabatan_active_status'
    ];
}
