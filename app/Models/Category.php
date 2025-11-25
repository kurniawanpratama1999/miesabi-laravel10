<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function products () {
        // KATEGORI -> PUNYA BANYAK -> PRODUK
        return $this->hasMany(Product::class);
    }
}

