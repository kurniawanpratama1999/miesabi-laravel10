<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'merge',
        'quantity'
    ];

    public function order () {
        return $this->belongsTo(Order::class);
    }

    public function products () {
        return $this->belongsToMany(Product::class);
    }

    public function variants () {
        return $this->belongsToMany(Variant::class);
    }
}
