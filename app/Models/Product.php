<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'code',
        'name',
        'price',
        'stock',
    ];

    public function category () {
        return $this->belongsTo(Category::class);
    }

    public function variant () {
        return $this->hasMany(Variant::class);
    }
    
    public function orders () {
        return $this->hasMany(Order::class);
    }
    
}
