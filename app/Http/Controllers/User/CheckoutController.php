<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{
    private static function processOrderDetails ($paramOrderDetails) {
        $orderDetails = [];
        foreach ($paramOrderDetails as $orderDetail) {
            $product = DB::table('products as p')
                ->select('p.id as product_id', 'p.name', 'v.id as variant_id', 'v.name as variant_name', 'p.price')
                ->leftJoin('variants as v', 'v.product_id', '=', 'p.id')
                ->where('p.id', '=', $orderDetail['product_id'])
                ->where('v.id', '=', $orderDetail['variant_id'])
                ->first();

            $product->quantity = $orderDetail['quantity'];
            $product->total = $product->price * $product->quantity;
            $orderDetails[] = $product;

            logger()->info($product->quantity);
        }

        return $orderDetails;
    }
    public function index()
    {
        $arrCheckouts = session('keranjangController.keranjangToCheckout');
        if (!$arrCheckouts) {
            return redirect()->route('menu.index');
        }
        
        $orders = $arrCheckouts['orders'];
        $orderDetails = $this->processOrderDetails($arrCheckouts['order_details']);
        $delivery = DeliveryMethod::where('id', '=', $orders['delivery_id'])->first();

        return view('pages.user.checkout', compact('orders', 'orderDetails', 'delivery'));
    }

    public function store(Request $req)
    {
        // UNTUK HANDLE BUAT PESANAN
        $arrCheckouts = session('keranjangController.keranjangToCheckout');

        $orders = $arrCheckouts['orders'];
        $orderDetails = $this->processOrderDetails($arrCheckouts['order_details']);
        
        $orders['code'] = uniqid($orders['user_id']);
        $orders['payment_status'] = 'belum lunas';
        $orders['order_status'] = 'menunggu';

        DB::beginTransaction();
        try {
            $createOrder=Order::create($orders);

            $order_id = $createOrder->id;
            
            foreach ($orderDetails as $orderDetail) {
                $sendToOrderDetail = [
                    "order_id" => $order_id,
                    "product_id" => $orderDetail->product_id,
                    "variant_id" => $orderDetail->variant_id,
                    "merge" => $orderDetail->product_id . "-" . $orderDetail->variant_id ?? 0,
                    "quantity" => $orderDetail->quantity,
                ];

                OrderDetail::create($sendToOrderDetail);
            }

            DB::commit();
            
            Session::forget('menuController.menuToKeranjang');
            Session::forget('keranjangController.keranjangToCheckout');

            return response()->json(['success' => true, 'redirect' => '/scanqr']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }
}
