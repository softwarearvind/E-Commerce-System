<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'user_id',
    'name',
    'phone',
    'address',
    'city',
    'pincode',
    'total_amount',
    'status',
    'payment_method',
    'payment_status',
];

public function items()
{
    return $this->hasMany(OrderItem::class);
}
 public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
