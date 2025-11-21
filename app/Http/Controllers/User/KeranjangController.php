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
        $datas = session('order_detail');

        $arr = [];
        foreach ($datas as $data) {
            $product = Product::with('variants')
                ->where('id', '=', $data['id'])
                ->first();

            $product->setAttribute('qty', $data['qty']);

            $arr[] = $product;
        }

        $delivery_methods = DeliveryMethod::all();
        return view('pages.user.keranjang', compact('arr', 'datas', 'delivery_methods'));
    }

    public function store(Request $req)
    {
        // UNTUK HANDLE CLICK CHECKOUT
        $datas = $req->input('datas');
        session(['checkout' => $datas]);

        return response()->json(['success' => true]);
    }
}
