<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $chosenProducts = session()->get('menuController.menuToCart');
        if (!$chosenProducts) {
            return redirect()->route('menu.index');
        }

        $getProducts = [];
        foreach ($chosenProducts as $chosenProduct) {
            $findProduct = Product::with('variants')
                ->where('id', '=', $chosenProduct['id'])
                ->first();

            $findProduct->setAttribute('quantity', $chosenProduct['quantity']);

            $getProducts[] = $findProduct;
        }

        $getDeliveryMethods = DeliveryMethod::all();
        return view('pages.user.cart', compact('getProducts', 'getDeliveryMethods'));
    }

    public function store(Request $req)
    {
        // UNTUK HANDLE CLICK CHECKOUT
        $payloadCartToCheckout = $req->input('payloadCartToCheckout');
        
        session()->put(['cartController.cartToCheckout' => $payloadCartToCheckout]);

        return response()->json(['success' => true, 'redirect' => route('checkout.index')]);
    }
}
