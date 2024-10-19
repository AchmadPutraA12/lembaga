<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_organization_type',
        'org_alamat',
        'org_defined_id',
        'org_kode',
        'org_kota',
        'org_logo',
        'org_nama',
        'org_nama_singkat',
        'org_status',
        'org_status',
        'org_telp',
        'org_website',
        'id_user',
        'org_email',
        'parent_organization_id'
    ];
}
