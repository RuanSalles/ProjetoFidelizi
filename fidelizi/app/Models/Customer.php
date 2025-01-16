<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

/**
 *
 */
class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'customers';
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'credit_points',
        'debit_points',
        'action',
        'last_transaction_date',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Customer $customer
     * @param $points
     * @return void
     */
    public function addPoints(Customer $customer, $points)
    {
        $customer->update(['points' => $points]);
    }

    /**
     * @param Customer $customer
     * @return void
     */
    public function scopeGetPoints(Customer $customer)
    {
        DB::table('customers')
            ->select('points')
            ->where('id', $customer)
            ->get('customers');
    }
}
