<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Balance extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'balance';
    protected $fillable = [
        'customer_id',
        'transaction_id',
        'points',
        'action',
        'date_transaction',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function scopeListForCustomer(Builder $query, $customerId)
    {
        return $query->where('customer_id', $customerId)->get();
    }
}
