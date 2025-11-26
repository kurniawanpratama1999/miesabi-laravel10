<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'delivery_id',
        'code',
        'payment_with',
        'payment_status',
        'order_status',
        'note',
        'address',
        'phone',
        'orders_receipt',
        'comment',
        'stars',

    ];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function delivery()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }
}
