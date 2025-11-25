<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    private static function processOrderDetails($paramOrderDetails)
    {
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
        $arrCheckouts = session()->get('cartController.cartToCheckout');
        if (!$arrCheckouts) {
            return redirect()->route('menu.index');
        }

        $orders = $arrCheckouts['orders'];
        $orderDetails = $this->processOrderDetails($arrCheckouts['order_details']);
        $delivery = DeliveryMethod::where('id', '=', $orders['delivery_id'])->first();
        $payment_with = $orders['payment_with'];

        return view('pages.user.checkout', compact('orders', 'orderDetails', 'delivery', 'payment_with'));
    }

    public function store()
    {
        // UNTUK HANDLE BUAT PESANAN
        $arrCheckouts = session()->get('cartController.cartToCheckout');

        $orders = $arrCheckouts['orders'];
        $orderDetails = $this->processOrderDetails($arrCheckouts['order_details']);

        $orders['user_id'] = Auth::user()->id;
        $orders['code'] = uniqid(Auth::user()->id);
        $orders['payment_status'] = 1;
        $orders['order_status'] = 1;

        DB::beginTransaction();
        try {
            $createOrder = Order::create($orders);

            $order_id = $createOrder->id;

            foreach ($orderDetails as $orderDetail) {
                $sendToOrderDetail = [
                    "order_id" => $order_id,
                    "product_id" => $orderDetail->product_id,
                    "variant_id" => $orderDetail->variant_id,
                    "merge" => $order_id . "-" . $orderDetail->product_id . "-" . $orderDetail->variant_id ?? 0,
                    "quantity" => $orderDetail->quantity,
                ];

                OrderDetail::create($sendToOrderDetail);
            }

            DB::commit();

            if ($orders['payment_with'] === 0) {
                return response()->json(['success' => true, 'redirect' => route('orders.show', Auth::user()->id)]);
            }

            session()->put('checkoutController.checkoutToPayment', [
                "order_id" => $order_id,
                "delivery_id" => $orders['delivery_id'],
                "subtotal" => collect($orderDetails)->sum('total')
            ]);

            session()->forget('menuController.menuToKeranjang');
            session()->forget('cartController.cartToCheckout');
            return response()->json(['success' => true, 'redirect' => route('scanqr.index')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }
}
