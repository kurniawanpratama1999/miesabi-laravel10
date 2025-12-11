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
        $productIds = array_column($paramOrderDetails, 'product_id');
        $variantIds = array_column($paramOrderDetails, 'variant_id');

        $products = DB::table('products as p')
            ->select(
                'p.id as product_id',
                'p.name',
                'p.price',
                'v.id as variant_id',
                'v.name as variant_name',
                'v.price as variant_price'
            )
            ->leftJoin('variants as v', 'v.product_id', '=', 'p.id')
            ->whereIn('p.id', $productIds)
            ->where(function ($q) use ($variantIds) {
                $q->whereIn('v.id', $variantIds)
                ->orWhereNull('v.id'); // <-- Produk tanpa variant
            })
            ->get()
            ->keyBy(function ($item) {
                return $item->product_id . '-' . ($item->variant_id ?? '0');
            });

        $orderDetails = [];

        foreach ($paramOrderDetails as $d) {
            $vID = $d['variant_id'] ?? 0;
            $key = $d['product_id'] . '-' . $vID;

            $product = $products[$key];

            // Harga variant null = 0
            $product->variant_price = $product->variant_price ?? 0;
            $product->variant_name = $product->variant_name ?? '-';

            $product->quantity = $d['quantity'];
            $product->total = ($product->price + $product->variant_price) * $d['quantity'];

            $orderDetails[] = $product;
        }

        return $orderDetails;
    }

    public function index()
    {
        $arrCheckouts = session()->get('cartController.cartToCheckout');
        if (!$arrCheckouts) {
            return redirect()->route('u.menu.index');
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
        if ($orders['delivery_id'] == 1) {
        $orders['address'] = ''; 
    }
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
            session()->forget('cartController.cartToCheckout');
            if ($orders['payment_with']== 1){
                $createOrder->update(['payment_status' => 2]);
                return response()->json(['success' => true, 'redirect' => route('u.orders.index')]);
            }elseif($orders['payment_with']== 2){
                      // Lanjut ke halaman scan qr code
                   session()->put('checkoutController.checkoutToPayment', [
                       "order_id" => $order_id,
                       "delivery_id" => $orders['delivery_id'],
                       "subtotal" => collect($orderDetails)->sum('total')
                   ]);
                   return response()->json(['success' => true, 'redirect' => route('u.scanqr.index')]);
            }
            else{
                return response()->json(['success' => true, 'redirect' => route('u.orders.index')]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }
}
