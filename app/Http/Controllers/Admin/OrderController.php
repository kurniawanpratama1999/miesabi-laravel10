<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders as o')
            ->select(
                'o.user_id',
                'u.name as user_name',
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
            ->leftJoin('users as u', 'u.id', '=', 'o.user_id')
            ->get();

        foreach ($orders as $order) {
            $subtotal = DB::table('order_details as od')
                ->join('products as p', 'p.id', '=', 'od.product_id')
                ->where('od.order_id', $order->id)
                ->sum(DB::raw('p.price * od.quantity'));
            $total = $subtotal + $order->delivery_price;
            $order->total_price = $total;
        }
        // return 'a';
        return view('pages.admin.order.ReadDelete', compact('orders'));
    }
    public function updatePaymentStatus(int $order_id)
    {
        $orderById = Order::findOrFail($order_id);
        $orderById->update([
            'payment_status' => 2
        ]);

        return redirect('/a/orders');
    }

    public function updateOrderStatus(int $order_id)
    {
        $orderById = Order::findOrFail($order_id);
        if ($orderById->order_status >= 7) {
            return back();
        }

        $updateNumber = $orderById->order_status + 1;
        $orderById->update([
            'order_status' => $updateNumber
        ]);

        return redirect('/a/orders');
    }

    public function rollbackOrderStatus(int $order_id)
    {
        $orderById = Order::findOrFail($order_id);
        if ($orderById->order_status <= 1) {
            return back();
        }

        $orderById->update([
            'order_status' => $orderById->order_status - 1
        ]);

        return redirect('/a/orders');
    }
}
