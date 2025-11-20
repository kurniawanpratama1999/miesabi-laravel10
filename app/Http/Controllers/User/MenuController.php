<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $datas = DB::table('products as p')
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->select('p.id', 'p.name', 'c.name as category_name', 'p.price')
            ->orderBy('category_name')
            ->orderBy('name')
            ->get();

        return view('pages.user.menu', compact('datas'));
    }
}
