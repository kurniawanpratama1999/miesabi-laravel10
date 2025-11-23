<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use App\Models\Order;
use DB;
use Illuminate\Http\Request;

class ScanQrController extends Controller
{
    public function index () {
        $checkoutPayment = session()->pull("checkoutController.checkoutToPayment");

        if (!$checkoutPayment) {
            return redirect('/orders/2');
        }

        $order_id = $checkoutPayment['order_id'];
        $delivery = DeliveryMethod::where('id', '=', $checkoutPayment['delivery_id'])->first();
        $total = (int) $checkoutPayment['subtotal'] + (int) $delivery->price;
        return view('pages.user.scanqr', compact('total', 'order_id'));
    }

    public function edit (string $id) {
        $order = DB::table('orders as o')
            ->select(
                'o.id',
                'd.price as delivery_price',
            )
            ->leftJoin('delivery_methods as d', 'd.id', '=', 'o.delivery_id')
            ->where('o.id', '=', $id)
            ->first();

            $subtotal = DB::table('order_details as od')
                ->join('products as p', 'p.id', '=', 'od.product_id')
                ->where('od.order_id', $order->id)
                ->sum(DB::raw('p.price * od.quantity'));
            $total = $subtotal + $order->delivery_price;
            $order->total_price = $total;
            $order_id = $order->id;
        return view('pages.user.scanqr', compact('total', 'order_id'));
    }

    public function update (string $id) {
        $order = Order::findOrFail($id);

        $order->update([
            'payment_status' => 1
        ]);

        return response()->json([
            'success' => true,
            'redirect' => '/orders/2'
        ]);
    }
}
