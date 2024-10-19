<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaAkreditasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'lembaga_nama',
        'lembaga_nama_singkat',
        'lembaga_status',
        'lembaga_logo'
    ];
}
