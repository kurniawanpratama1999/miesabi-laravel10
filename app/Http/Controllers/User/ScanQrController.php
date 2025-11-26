<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barcode;
use App\Models\DeliveryMethod;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScanQrController extends Controller
{
    public function index()
    {
        $checkoutPayment = session()->pull("checkoutController.checkoutToPayment");

        if (!$checkoutPayment) {
            return redirect()->route('u.orders.show', Auth::user()->id);
        }

        $barcode = Barcode::first();
        $order_id = $checkoutPayment['order_id'];
        $delivery = DeliveryMethod::where('id', '=', $checkoutPayment['delivery_id'])->first();
        $total = (int) $checkoutPayment['subtotal'] + (int) $delivery->price;

        return view('pages.user.scanqr', compact('total', 'order_id', 'barcode'));
    }

    public function show(string $id)
    {
        $order = DB::table('orders as o')
            ->select(
                'o.user_id',
                'o.id',
                'd.price as delivery_price',
            )
            ->leftJoin('delivery_methods as d', 'd.id', '=', 'o.delivery_id')
            ->where('o.id', '=', $id)
            ->where('o.user_id', '=', Auth::user()->id)
            ->first();

        $subtotal = DB::table('order_details as od')
            ->leftJoin('products as p', 'p.id', '=', 'od.product_id')
            ->leftJoin('variants as v', 'v.id', '=', 'od.variant_id')
            ->where('od.order_id', $order->id)
            ->sum(DB::raw('(p.price + COALESCE(v.price, 0)) * od.quantity'));
        $total = $subtotal + $order->delivery_price;
        $order->total_price = $total;
        $order_id = $order->id;

        return view('pages.user.scanqr', compact('total', 'order_id'));
    }

    public function update(Request $req, int $id)
    {
        try {
            $order = Order::findOrFail($id);

            $req->validate([
                'orders_receipt' => ['required', 'file', 'mimes:png,jpg', 'max:2048']
            ]);

            if ($order->orders_receipt && file_exists(storage_path('app/public/' . $order->orders_receipt))) {
                unlink(storage_path('app/public/' . $order->orders_receipt));
            }

            $receiptPath = $req->file('orders_receipt')->store('orders_receipt', 'public');

            $order->update([
                'orders_receipt'  => $receiptPath,
                'payment_status' => 2
            ]);

            return redirect()->route('u.orders.index');
        } catch (\Throwable $th) {
            return redirect()->route('u.orders.index');
        }
    }
}
