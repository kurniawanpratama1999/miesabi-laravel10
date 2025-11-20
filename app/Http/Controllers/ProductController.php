<?php

namespace App\Http\Controllers;

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
            ->select('products.id', 'products.name', 'categories.name as category_name', 'products.price', 'products.stock')
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
            ->select('products.id', 'products.name', 'categories.name as category_name', 'products.price', 'products.stock')
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
            $validate = $req->validate([
                'name' => ['required', 'string'],
                'category_id' => ['required', 'integer'],
                'price' => ['required', 'numeric'],
                'stock' => ['required', 'numeric']
            ]);

            Product::create($validate);
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function update(Request $req, int $id)
    {
        // LOGIKA dan PERINTAH untuk UPDATE (update) data ke DB_table "categories"
        // BERDASARKAN ID yang sudah ditentukan pada tampilan EDIT.
        try {
            $validate = $req->validate([
                'name' => ['required', 'string'],
                'category_id' => ['required', 'integer'],
                'price' => ['required', 'numeric'],
                'stock' => ['required', 'numeric']
            ]);

            $findByID = Product::findOrFail($id);
            $findByID->update($validate);

            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {
        // LOGIKA dan PERINTAH untuk DELETE (delete) data ke DB_table "categories"
    }
}
