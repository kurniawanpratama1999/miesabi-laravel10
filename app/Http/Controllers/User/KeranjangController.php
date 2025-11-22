<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use App\Models\Product;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $chosenProducts = session()->get('menuController.menuToKeranjang');
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
        return view('pages.user.keranjang', compact('getProducts', 'getDeliveryMethods'));
    }

    public function store(Request $req)
    {
        // UNTUK HANDLE CLICK CHECKOUT
        $payloadKeranjangToCheckout = $req->input('payloadKeranjangToCheckout');
        session(['keranjangController.keranjangToCheckout' => $payloadKeranjangToCheckout]);

        return response()->json(['success' => true, 'redirect' => '/checkout']);
    }
}
