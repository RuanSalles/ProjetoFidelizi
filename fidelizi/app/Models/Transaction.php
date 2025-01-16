<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 *
 */
class Transaction extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'transactions';
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'customer_id',
        'amount',
        'generated_points',
    ];

    /**
     * @return void
     */
    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return void
     */
    public function customer() {
        $this->belongsTo(Customer::class, 'customer_id');
    }
}
