<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariantController extends Controller
{
    /* =======================================================================================================
    Kolom yang harus di isi adalah :
        - name -> maksudnya nama dari kategori produk seperti "Makanan", "Minuman", "Snack", "Desert", "dll"
    ======================================================================================================== */

    public function index()
    {
        // MENAMPILKAN DAFTAR (read) Kategori Produk dari DB_Table "categories"

        // ambil semua data
        $datas = DB::table('variants')
            ->leftJoin('products', 'products.id', '=', 'variants.product_id')
            ->select('variants.id', 'variants.name', 'products.name as product_name', 'variants.price')
            ->orderBy('product_name')
            ->get();

        $products = Product::all();

        // kembalikan function untuk render halaman 'display' dan lempar variable $datas
        // agar $datas bisa digunakan pada halaman kategori
        return view('pages.admin.variant.CreateReadUpdateDelete', compact("datas", 'products'));
    }

    public function edit(int $id)
    {
        // MENAMPILKAN DAFTAR (read) Kategori Produk dari DB_Table "categories"

        // ambil semua data
        $datas = DB::table('variants')
            ->leftJoin('products', 'products.id', '=', 'variants.product_id')
            ->select('variants.id', 'variants.name', 'products.name as product_name', 'variants.price')
            ->orderBy('product_name')
            ->get();

        $products = Product::all();

        // ambil data berdasarkan ID
        $variant = Variant::findOrFail($id);

        // kembalikan function untuk render halaman 'display' dan lempar variable $datas
        // agar $datas bisa digunakan pada halaman kategori
        return view(
            'pages.admin.variant.CreateReadUpdateDelete',
            compact("datas", 'delivery', 'products')
        );
    }

    public function store(Request $req)
    {
        // LOGIKA dan PERINTAH untuk MENAMBAH (Create) data ke DB_table "categories"
        try {
            $validate = $req->validate([
                'name' => ['required', 'string'],
                'product_id' => ['required', 'integer'],
                'price' => ['required', 'numeric']
            ]);

            Variant::create($validate);
            return redirect()->route('delivery.index');
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
                'product_id' => ['required', 'integer'],
                'price' => ['required', 'numeric']
            ]);
            $findByID = Variant::findOrFail($id);
            $findByID->update($validate);

            return redirect()->route('delivery.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {
        // LOGIKA dan PERINTAH untuk DELETE (delete) data ke DB_table "categories"
    }
}
