<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepemilikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_organization_id',
        'parent_organization_id'
    ];
}
