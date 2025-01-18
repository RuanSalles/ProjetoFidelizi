<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
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
        'points',
        'active',
        'name',
        'email',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @param Customer $customer
     * @param $points
     * @return \Illuminate\Http\JsonResponse
     */
    static function addPoints($id, $points)
    {
        $customer = Customer::find($id);
        $points = $customer->points += $points;
        $customer->update(['points' => $points]);

        return response()->json($customer);
    }

    static function debitPoints($id, $points)
    {
        $customer = Customer::find($id);

        if(!self::checkPointsRescue($id, $points)) {
            throw new Exception("Don't have enough points");
        }

        $points = $customer->points -= $points;
        $customer->update(['points' => $points]);

        return response()->json($customer);
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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    static function checkPointsRescue($id, $points)
    {
        $customer = Customer::find($id);
        if ($customer->points < $points) {
            return false;
        }
        return true;
    }
}
