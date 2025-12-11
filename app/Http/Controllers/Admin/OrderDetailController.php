<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    public function show (int $id) {

        $orderDetails = OrderDetail::with(['product', 'variant'])
            ->where('order_id', '=', $id)
            ->get();

        $order = DB::table('orders as o')
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
                'o.payment_with',
                'o.payment_status',
                'o.order_status',
                'o.address',
                'o.phone',
                'o.note',
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
                'o.payment_with',
                'o.payment_status',
                'o.order_status',
                'o.address',
                'o.phone',
                'o.note',
                'o.created_at',
                'd.id',
                'd.name',
                'd.price'
            )->where('o.id', '=', $id)
            ->first();

        
        return view('pages.admin.orderDetails', compact('orderDetails', 'order'));
    }
}
