<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelbackground extends Model
{
    use HasFactory;
    protected $fillable = [
        'images',
        'name',
        'id_tag'
    ];

    protected $casts = [
        'id_tag'  => 'array',
    ];
}
