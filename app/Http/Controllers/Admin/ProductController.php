<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /* =======================================================================================================
    Kolom yang harus di isi adalah :
        - name -> maksudnya nama dari kategori produk seperti "Makanan", "Minuman", "Snack", "Desert", "dll"
    ======================================================================================================== */

    public function index()
    {
        // MENAMPILKAN DAFTAR (read) Kategori Produk dari DB_Table "categories"

        // ambil semua data
        $datas = DB::table('products')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.id', 'products.photo', 'products.name', 'categories.name as category_name', 'products.price', 'products.stock')
            ->orderBy('name')
            ->get();

        $categories = Category::all();

        // kembalikan function untuk render halaman 'display' dan lempar variable $datas
        // agar $datas bisa digunakan pada halaman kategori
        return view('pages.admin.product.CreateReadUpdateDelete', compact("datas", 'categories'));
    }

    public function edit(int $id)
    {
        // MENAMPILKAN DAFTAR (read) Kategori Produk dari DB_Table "categories"

        // ambil semua data
        $datas = DB::table('products')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.id', 'products.photo', 'products.name', 'categories.name as category_name', 'products.price', 'products.stock')
            ->orderBy('name')
            ->get();

        $categories = Category::all();

        // ambil data berdasarkan ID
        $product = Product::findOrFail($id);

        // kembalikan function untuk render halaman 'display' dan lempar variable $datas
        // agar $datas bisa digunakan pada halaman kategori
        return view(
            'pages.admin.product.CreateReadUpdateDelete',
            compact("datas", 'product', 'categories')
        );
    }

    public function store(Request $req)
    {
        // LOGIKA dan PERINTAH untuk MENAMBAH (Create) data ke DB_table "categories"
        try {
            DB::beginTransaction();
            $validate = $req->validate([
                'photo' => ['required', 'file', 'size:2404', 'mimes:png,jpg'],
                'name' => ['required', 'string'],
                'category_id' => ['required', 'integer'],
                'price' => ['required', 'numeric'],
                'stock' => ['required', 'nDB::beginTransaction();umeric']
            ]);

            $photoPath = $validate['photo']->store('products', 'public');

            Product::create([
                'photo' => $photoPath,
                'name' => $validate['name'],
                'category_id' => $validate['category_id'],
                'price' => $validate['price'],
                'stock' => $validate['stock']
            ]);

            DB::commit();
            return redirect()->route('products.index');
        } catch (\Throwable $th) {
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
                'stock' => ['required', 'numeric']
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
            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {
        Product::destroy($id);
        return redirect()->route('products.index');
    }
}
