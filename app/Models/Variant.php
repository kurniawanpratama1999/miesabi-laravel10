<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'product_id',
        'variant_name',
    ];

    public function category () {
        return $this->belongsTo(Category::class);
    }

    public function products () {
        return $this->belongsTo(Product::class);
    }
}
