<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = ['token', 'permissions'];

    protected $casts = [
        'permissions' => 'array', // Permite tratar permissões como array
    ];
}
