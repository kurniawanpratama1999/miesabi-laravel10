<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'stock',
    ];

    public function category () {
        return $this->belongsTo(Category::class);
    }
    public function variants () {
        return $this->hasMany(Variant::class);
    }

    public function order_details () {
        return $this->hasMany(Order::class);
    }

}
