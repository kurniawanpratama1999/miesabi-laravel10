<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $datas = Category::orderBy('name', 'asc')->get();

        return view('pages.admin.categories', compact("datas"));
    }

    public function edit(int $id)
    {
        $datas = Category::orderBy('name', 'asc')->get();

        $category = Category::findOrFail($id);

        return view(
            'pages.admin.categories',
            compact("datas", 'category')
        );
    }

    public function store(Request $req)
    {
        try {
            $validate = $req->validate([
                'name' => ['required', 'string']
            ]);

            Category::create($validate);
            return redirect()->route('a.categories.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function update(Request $req, int $id)
    {
        try {
            $validate = $req->validate([
                'name' => ['required', 'string']
            ]);
            $findByID = Category::findOrFail($id);
            $findByID->update($validate);

            return redirect()->route('a.categories.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {
        Category::destroy($id);
        return redirect()->route('a.categories.index');
    }
}
