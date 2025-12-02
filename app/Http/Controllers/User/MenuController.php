<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {

        $dbTableProducts = DB::table('products as p')
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->select('p.id', 'p.photo', 'p.name', 'c.name as category_name', 'p.price')
            ->orderBy('category_name')
            ->orderBy('name')
            ->get();

        return view('pages.user.menu', compact('dbTableProducts'));
    }

    public function store(Request $req)
    {
        try {
            $payloadMenuToCart = $req->input('payloadMenuToCart');
            session()->put('menuController.menuToCart', $payloadMenuToCart);

            return response()->json([
                "success" => true,
                "redirect" => route('u.cart.index')
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => $th->getMessage()
            ]);
        }
    }
}
