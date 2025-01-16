<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class RescueAward extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'rescue_awards';
    protected $fillable = [
        'customer_id',
        'award_id',
        'debit_points',
        'date_rescue',
    ];
}
