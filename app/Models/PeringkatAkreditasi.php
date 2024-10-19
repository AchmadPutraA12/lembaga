<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeringkatAkreditasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'peringkat_nama', 'peringkat_logo', 'peringkat_akreditasi_active_status'
    ];
}
