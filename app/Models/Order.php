<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'variant_id',
        'merge',
        'quantity',

    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
    
    public function products () {
        return $this->belongsToMany(Product::class);
    }
    
    public function variant () {
        return $this->belongsTo(Variant::class);
    }

    public function order_detail () {
        return $this->hasOne(OrderDetail::class);
    }
}
