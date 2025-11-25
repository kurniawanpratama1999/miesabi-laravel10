<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'photo',
        'name',
        'category_id',
        'price',
        'stock',
    ];

    public function category()
    {
        // PRODUCT -> MILIKnya -> KATEGORI
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        // PRODUCT -> PUNYA BANYAK -> VARIANT
        return $this->hasMany(Variant::class);
    }

    public function order_details()
    {
        // PRODUCT -> PUNYA BANYAK -> ORDER DETAILS
        return $this->hasMany(Order::class);
    }
}
