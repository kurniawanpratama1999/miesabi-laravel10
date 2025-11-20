<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $datas = session('order_detail');
        
        $arr = [];
        foreach($datas as $data) {
            $arr[] = Product::with('variants')
                        ->where('id', '=', $data['id'])
                        ->get();    
        }

        return view('pages.user.keranjang', compact('arr', 'datas'));
    }
    public function store(Request $req)
    {
        $datas = $req->input('datas');
        session(['order_detail' => $datas]);

        return response()->json([
            'success' => true,
            'datas' => $datas
        ]);
    }
}
