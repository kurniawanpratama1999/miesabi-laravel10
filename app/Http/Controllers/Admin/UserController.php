<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $datas = User::all();

        $roles = ['admin', 'user'];

        return view('pages.admin.user.CreateReadUpdateDelete', compact("datas", 'roles'));
    }

    public function edit(int $id)
    {
        $datas = User::all();
        $user = User::findOrFail($id);
        $roles = ['admin', 'user'];


        return view(
            'pages.admin.user.CreateReadUpdateDelete',
            compact("datas", 'roles', 'user')
        );
    }

    public function store(Request $req)
    {
        try {
            $validate = $req->validate([
                'role' => ['required', 'string'],
                'name' => ['required', 'string'],
                'username' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6'],
                'password_confirmation' => ['same:password'],
            ]);

            unset($validate['password_confirmation']);
            $validate['password'] = Hash::make($validate['password']);

            User::create($validate);
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function update(Request $req, int $id)
    {
        try {
            $validate = $req->validate([
                'role' => ['required', 'string'],
                'name' => ['required', 'string'],
                'username' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'email' => ['required', 'email'],
                'password' => ['nullable', 'min:6'],
                'password_confirmation' => ['nullable', 'same:password'],
            ]);
            
            $findByID = User::findOrFail($id);
            if (empty($validate['password']) || $validate['password'] == null) {
                unset($validate['password'], $validate['password_confirmation']);
            }
            
            unset($validate['password_confirmation']);
            
            $validate['password'] = Hash::make($validate['password']);
            $findByID->update($validate);

            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {

    }
}
