<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        return view('pages.user.keranjang');
    }
    public function store(Request $req)
    {
        $data = $req->input('data');

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
