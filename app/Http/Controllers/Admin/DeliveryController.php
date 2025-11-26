<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /* =======================================================================================================
    Kolom yang harus di isi adalah :
        - name -> maksudnya nama dari kategori produk seperti "Makanan", "Minuman", "Snack", "Desert", "dll"
    ======================================================================================================== */

    public function index()
    {
        // MENAMPILKAN DAFTAR (read) Kategori Produk dari DB_Table "categories"

        // ambil semua data
        $datas = DeliveryMethod::orderBy('name', 'asc')->get();

        // kembalikan function untuk render halaman 'display' dan lempar variable $datas
        // agar $datas bisa digunakan pada halaman kategori
        return view('pages.admin.delivery.CreateReadUpdateDelete', compact("datas"));
    }

    public function edit(int $id)
    {
        // MENAMPILKAN DAFTAR (read) Kategori Produk dari DB_Table "categories"

        // ambil semua data
        $datas = DeliveryMethod::orderBy('name', 'asc')->get();

        // ambil data berdasarkan ID
        $delivery = DeliveryMethod::findOrFail($id);

        // kembalikan function untuk render halaman 'display' dan lempar variable $datas
        // agar $datas bisa digunakan pada halaman kategori
        return view(
            'pages.admin.delivery.CreateReadUpdateDelete',
            compact("datas", 'delivery')
        );
    }

    public function store(Request $req)
    {
        // LOGIKA dan PERINTAH untuk MENAMBAH (Create) data ke DB_table "categories"
        try {
            $validate = $req->validate([
                'name' => ['required', 'string'],
                'price' => ['required', 'numeric']
            ]);

            DeliveryMethod::create($validate);
            return redirect()->route('a.deliveries.index');
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
                'price' => ['required', 'numeric']
            ]);
            $findByID = DeliveryMethod::findOrFail($id);
            $findByID->update($validate);

            return redirect()->route('a.deliveries.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {
        // LOGIKA dan PERINTAH untuk DELETE (delete) data ke DB_table "categories"
    }
}
