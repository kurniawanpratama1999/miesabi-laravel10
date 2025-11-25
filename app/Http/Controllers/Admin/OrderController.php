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
            ->leftJoin('delivery_methods as d', 'd.id', '=', 'o.delivery_id')
            ->leftJoin('users as u', 'u.id', '=', 'o.user_id')
            ->leftJoin('order_details as od', 'od.order_id', '=', 'o.id')
            ->leftJoin('products as p', 'p.id', '=', 'od.product_id')
            ->leftJoin('variants as v', 'v.id', '=', 'od.variant_id')
            ->select(
                'o.id',
                'o.code',
                'o.user_id',
                'u.name as user_name',
                'o.orders_receipt',
                'o.payment_with',
                'o.payment_status',
                'o.order_status',
                'o.address',
                'o.created_at',
                'd.id as delivery_id',
                'd.name as delivery_name',
                'd.price as delivery_price',
                DB::raw('SUM((COALESCE(v.price, 0) + p.price) * od.quantity) as subtotal'),
                DB::raw('SUM((COALESCE(v.price, 0) + p.price) * od.quantity) + d.price as total_price')
            )
            ->groupBy(
                'o.id',
                'o.code',
                'o.user_id',
                'u.name',
                'o.orders_receipt',
                'o.payment_with',
                'o.payment_status',
                'o.order_status',
                'o.address',
                'o.created_at',
                'd.id',
                'd.name',
                'd.price'
            )
            ->get();

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
