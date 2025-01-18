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
        'customer_id',
        'amount',
        'generated_points',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
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

    /**
     * @return void
     */
    public function balances()
    {
        $this->hasMany(Balance::class, 'transaction_id');
    }

    static function calculatePoints($amount)
    {
        return intval(floor($amount / 5));
    }
}
