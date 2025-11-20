<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $datas = session('checkout');
        // logger()->info(json_encode($datas));

        $arr = [];

        $orders = $datas['orders'];
        $order_details = $datas['order_details'];
        foreach($order_details as $od) {

            logger()->info($od);            

        }

        return view('pages.user.checkout', compact('datas'));
    }

    public function store (Request $req) {
        $datas = $req->input('datas');
        session(['checkout'=> $datas]);

        return response()->json(['success' => true]);
    }
}
