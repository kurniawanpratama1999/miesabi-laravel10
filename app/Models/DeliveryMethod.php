<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];

    public function order () {
        return $this->hasMany(Order::class);
    }
}
