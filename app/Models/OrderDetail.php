<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'metode',
        'payment',
        'status',
        'subtotal',
        'ongkir',
        'total',
        'note',
        'address',
        'phone',
    ];

    public function order () {
        return $this->belongsTo(Order::class);
    }
}
