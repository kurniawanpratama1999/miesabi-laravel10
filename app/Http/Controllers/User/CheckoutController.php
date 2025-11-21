<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $datas = session('checkout');

        $arr = [];

        $orders = $datas['orders'];
        $order_details = $datas['order_details'];
        foreach ($order_details as $od) {
            $product = DB::table('products as p')
                ->select('p.id as product_id', 'p.name', 'v.id as variant_id', 'v.name as variant_name', 'p.price')
                ->leftJoin('variants as v', 'v.product_id', '=', 'p.id')
                ->where('p.id', '=', $od['product_id'])
                ->where('v.id', '=', $od['variant_id'])
                ->first();

            $product->qty = $od['qty'];
            $product->total = $product->price * $product->qty;
            $arr[] = $product;
        }

        $delivery = DeliveryMethod::where('id', '=', $orders['delivery_id'])->first();
        return view('pages.user.checkout', compact('orders', 'arr', 'delivery'));
    }

    public function store(Request $req)
    {
        // UNTUK HANDLE BUAT PESANAN
        $datas = session('checkout');
        $arr = [];
        $orders = $datas['orders'];
        $order_details = $datas['order_details'];
        foreach ($order_details as $od) {
            $product = DB::table('products as p')
                ->select('p.id as product_id', 'p.name', 'v.id as variant_id', 'v.name as variant_name', 'p.price')
                ->leftJoin('variants as v', 'v.product_id', '=', 'p.id')
                ->where('p.id', '=', $od['product_id'])
                ->where('v.id', '=', $od['variant_id'])
                ->first();

            $product->qty = $od['qty'];
            $product->total = $product->price * $product->qty;
            $arr[] = $product;
        }

        $orders['code'] = uniqid($orders['user_id']);

        DB::beginTransaction();
        try {
            Order::create($orders);

            $order_id = Order::insertGetId();

            foreach ($arr as $order_detail) {
                OrderDetail::create([
                    "order_id" => $order_id,
                    "product_id" => $order_detail['product_id'],
                    "variant_id" => $order_detail['variant_id'],
                    "merge" => $order_detail['merge'],
                    "quantity" => $order_detail['qty'],
                ]);
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['success' => false]);
        }
    }
}
