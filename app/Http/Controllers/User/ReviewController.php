<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
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
                'o.payment_with',
                'o.payment_status',
                'o.order_status',
                'o.stars',
                'o.comment',
                'o.created_at',
                'd.id as delivery_id',
                'd.name as delivery_name',
                'd.price as delivery_price',
                DB::raw('SUM((COALESCE(v.price, 0) + p.price) * od.quantity) as subtotal'),
                DB::raw('SUM((COALESCE(v.price, 0) + p.price) * od.quantity) + d.price as total_price')
            )
            ->where('o.user_id', '=', Auth::user()->id)
            ->groupBy(
                'o.id',
                'o.code',
                'o.user_id',
                'o.payment_with',
                'o.payment_status',
                'o.order_status',
                'o.stars',
                'o.comment',
                'o.created_at',
                'd.id',
                'd.name',
                'd.price'
            )
            ->get();

        return view('pages.user.ulasan', compact('orders'));
    }
    public function show(int $id)
    {
        $orders = Order::where('user_id', '=', Auth::user()->id)
            ->where('order_status', '=', 7)
            ->get();

        $order = Order::findOrFail($id);
        return view('pages.user.ulasan', compact('orders', 'order'));
    }
    public function update(Request $req, int $id)
    {
        $order = Order::findOrFail($id);

        $validate = $req->validate([
            'star' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'max:500']
        ]);

        $order->update($validate);

        return redirect()->route('u.orders.index');
    }
}
