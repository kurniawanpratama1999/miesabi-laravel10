<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function show (int $id) {

        $orderDetails = OrderDetail::with(['product', 'variant'])
        ->where('order_id', '=', $id)
        ->get();
        
        return view('pages.user.orderDetails', compact('orderDetails'));
    }
}
