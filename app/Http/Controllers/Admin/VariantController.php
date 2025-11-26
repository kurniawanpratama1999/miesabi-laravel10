<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariantController extends Controller
{
    public function index()
    {
        $datas = DB::table('variants')
            ->leftJoin('products', 'products.id', '=', 'variants.product_id')
            ->select('variants.id', 'variants.name', 'products.name as product_name', 'variants.price')
            ->orderBy('product_name')
            ->get();

        $products = Product::all();

        return view('pages.admin.variant.CreateReadUpdateDelete', compact("datas", 'products'));
    }

    public function edit(int $id)
    {
        $datas = DB::table('variants')
            ->leftJoin('products', 'products.id', '=', 'variants.product_id')
            ->select('variants.id', 'variants.name', 'products.name as product_name', 'variants.price')
            ->orderBy('product_name')
            ->get();

        $products = Product::all();

        $variant = Variant::findOrFail($id);

        return view(
            'pages.admin.variant.CreateReadUpdateDelete',
            compact("datas", 'variant', 'products')
        );
    }

    public function store(Request $req)
    {
        try {
            $validate = $req->validate([
                'name' => ['required', 'string'],
                'product_id' => ['required', 'integer'],
                'price' => ['required', 'numeric']
            ]);

            Variant::create($validate);
            return redirect()->route('a.variants.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function update(Request $req, int $id)
    {
        try {
            $validate = $req->validate([
                'name' => ['required', 'string'],
                'product_id' => ['required', 'integer'],
                'price' => ['required', 'numeric']
            ]);
            $findByID = Variant::findOrFail($id);
            $findByID->update($validate);

            return redirect()->route('a.variants.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id) {}
}
