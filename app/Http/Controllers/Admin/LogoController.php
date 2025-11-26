<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogoController extends Controller
{
    public function index()
    {
        $data = Logo::first();

        return view('pages.admin.logo', compact("data"));
    }

    public function edit(int $id)
    {
        $datas = Logo::first();
        $logo = Logo::findOrFail($id);

        return view(
            'pages.admin.logo',
            compact("datas", 'logo')
        );
    }

    public function store(Request $req)
    {
        try {

            $validate = $req->validate([
                'photo' => ['required', 'file', 'mimes:png,jpg', 'max:3072'],
            ]);

            DB::beginTransaction();

            $photoPath = $validate['photo']->store('logo', 'public');

            Logo::create([
                'photo' => $photoPath
            ]);
            DB::commit();
            return redirect()->route('a.logo.index');
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

            $findByID = Logo::findOrFail($id);
            if ($req->hasFile('photo')) {
                if ($findByID->photo && file_exists(storage_path('app/public/' . $findByID->photo))) {
                    unlink(storage_path('app/public/' . $findByID->photo));
                }
            }

            $photoPath = $req->file('photo')->store('logo', 'public');
            $findByID->update([
                'photo' => $photoPath
            ]);

            return redirect()->route('a.logo.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id) {}
}
