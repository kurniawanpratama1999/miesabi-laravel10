<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'price',
    ];

    public function product () {
        return $this->belongsTo(Product::class);
    }

    public function order_details () {
        return $this->hasMany(OrderDetail::class);
    }
}
