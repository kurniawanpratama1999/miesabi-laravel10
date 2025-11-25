<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index () {
        $orders = DB::table('orders as o')
            ->select(
                'o.user_id',
                'd.id as delivery_id',
                'd.name as delivery_name',
                'd.price as delivery_price',
                'o.id',
                'o.code',
                'o.payment_with',
                'o.payment_status',
                'o.order_status',
                'o.address',
                'o.created_at'
            )
            ->leftJoin('delivery_methods as d', 'd.id', '=', 'o.delivery_id')
            ->where('o.user_id', '=', Auth::user()->id)
            ->get();

        foreach ($orders as $order) {
            $subtotal = DB::table('order_details as od')
                ->join('products as p', 'p.id', '=', 'od.product_id')
                ->where('od.order_id', $order->id)
                ->sum(DB::raw('p.price * od.quantity'));
            $total = $subtotal + $order->delivery_price;
            $order->total_price = $total;
        }


        return view('pages.user.orders', compact('orders'));
    }

    public function update (int $id) {
        $order = Order::findOrFail($id);
        $order->update([
            'order_status' => 7
        ]);

        return redirect()->route('orders.index');
    }
}
