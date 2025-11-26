<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barcode;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarcodeController extends Controller
{
    public function index()
    {
        $datas = Barcode::all();

        return view('pages.admin.barcode.CreateReadUpdateDelete', compact("datas"));
    }

    public function edit(int $id)
    {
        $datas = Barcode::all();
        $barcode = Barcode::findOrFail($id);

        return view(
            'pages.admin.barcode.CreateReadUpdateDelete',
            compact("datas", 'barcode')
        );
    }

    public function store(Request $req)
    {   
        try {
            
            $validate = $req->validate([
                'photo' => ['required', 'file', 'mimes:png,jpg', 'max:3072'],
            ]);

            DB::beginTransaction();

            $photoPath = $validate['photo']->store('products', 'public');

            Barcode::create([
                'photo' => $photoPath
            ]);
            DB::commit();
            return redirect()->route('barcode.index');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput();
        }
    }

    public function update(Request $req, int $id)
    {
        try {
            $validate = $req->validate([
                'photo' => ['required', 'file', 'mimes:png,jpg', 'max:3072'],
            ]);

            $findByID = Barcode::findOrFail($id);
            if ($req->hasFile('photo')) {
                if ($findByID->photo && file_exists(storage_path('app/public/' . $findByID->photo))) {
                    unlink(storage_path('app/public/' . $findByID->photo));
                }
            }
            
            $photoPath = $req->file('photo')->store('barcode', 'public');
            $findByID->update([
                'photo' => $photoPath
            ]);

            return redirect()->route('barcode.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {

    }
}
