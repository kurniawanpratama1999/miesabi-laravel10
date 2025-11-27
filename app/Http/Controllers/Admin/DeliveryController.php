<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $datas = DeliveryMethod::orderBy('name', 'asc')->get();

        return view('pages.admin.deliveries', compact("datas"));
    }

    public function edit(int $id)
    {
        $datas = DeliveryMethod::orderBy('name', 'asc')->get();

        $delivery = DeliveryMethod::findOrFail($id);

        return view(
            'pages.admin.deliveries',
            compact("datas", 'delivery')
        );
    }

    public function store(Request $req)
    {
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
        DeliveryMethod::destroy($id);
        return redirect()->route('a.deliveries.index');
    }
}
