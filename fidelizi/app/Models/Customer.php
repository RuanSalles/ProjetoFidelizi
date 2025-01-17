<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'points',
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
    public function addPoints($id, $points)
    {
        return Customer::where('id', $id)->update(['credit_points' => $points]);
    }

    /**
     * @param Customer $customer
     * @return void
     */
    public function scopeGetPoints(Builder $query, $id)
    {
        $query->select('points')
        ->where('id', $id);
    }
}
