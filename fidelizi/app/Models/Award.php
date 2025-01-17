<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 *
 */
class Award extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'awards';
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'points_value',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
