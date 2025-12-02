<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $datas = DB::table('products')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.id', 'products.photo', 'products.name', 'categories.name as category_name', 'products.price', 'products.stock')
            ->orderBy('name')
            ->get();

        $categories = Category::all();

        return view('pages.admin.products', compact("datas", 'categories'));
    }

    public function edit(int $id)
    {
        $datas = DB::table('products')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.id', 'products.photo', 'products.name', 'categories.name as category_name', 'products.price', 'products.stock')
            ->orderBy('name')
            ->get();

        $categories = Category::all();

        $product = Product::findOrFail($id);

        return view(
            'pages.admin.products',
            compact("datas", 'product', 'categories')
        );
    }

    public function store(Request $req)
    {
        logger()->info('Mulai');
        try {
            logger()->info('TRY');
            DB::beginTransaction();
            $validate = $req->validate([
                'photo' => ['required', 'file', 'max:2404', 'mimes:png,jpg'],
                'name' => ['required', 'string'],
                'category_id' => ['required', 'integer'],
                'price' => ['required', 'numeric'],
                'stock' => ['required', 'integer']
            ]);
            logger()->info('Jalan1');

            $photoPath = $req->file('photo')->store('products', 'public');
            logger()->info('Jalan2');

            Product::create([
                'photo' => $photoPath,
                'name' => $validate['name'],
                'category_id' => $validate['category_id'],
                'price' => $validate['price'],
                'stock' => $validate['stock']
            ]);
            logger()->info('Jalan3');

            DB::commit();
            logger()->info('Selesai');
            return redirect()->route('a.products.index');
        } catch (\Throwable $th) {
            logger()->info('Error');
            logger()->info($th);
            DB::rollback();
            return back()->withInput();
        }
    }

    public function update(Request $req, int $id)
    {
        try {
            DB::beginTransaction();
            $validate = $req->validate([
                'photo' => ['nullable', 'file', 'max:2048', 'mimes:png,jpg'],
                'name' => ['required', 'string'],
                'category_id' => ['required', 'integer'],
                'price' => ['required', 'numeric'],
                'stock' => ['required', 'integer']
            ]);

            $findByID = Product::findOrFail($id);

            if ($req->hasFile('photo')) {

                // Hapus foto lama jika ada
                if ($findByID->photo && file_exists(storage_path('app/public/' . $findByID->photo))) {
                    unlink(storage_path('app/public/' . $findByID->photo));
                }

                $photoPath = $req->file('photo')->store('products', 'public');

                $findByID->update([
                    'photo'       => $photoPath,
                    'name'        => $validate['name'],
                    'category_id' => $validate['category_id'],
                    'price'       => $validate['price'],
                    'stock'       => $validate['stock']
                ]);
            } else {
                $findByID->update([
                    'name'        => $validate['name'],
                    'category_id' => $validate['category_id'],
                    'price'       => $validate['price'],
                    'stock'       => $validate['stock']
                ]);
            }

            DB::commit();
            return redirect()->route('a.products.index');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {
        Product::destroy($id);
        return redirect()->route('a.products.index');
    }
}
