<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index () {
        return view('pages.guest.register');
    }

    public function register (Request $req) {
        $validate = $req->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
            'password_confirmation' => ['required', 'string', 'same:password'],
        ]);

        try {
            User::create([
                'name' => $validate['name'],
                'username' => $validate['username'],
                'phone' => $validate['phone'],
                'email' => $validate['email'],
                'password' => $validate['password'],
            ]);

            logger()->info("Register: Berhasil");
            return redirect()->route('login');
        } catch (\Throwable $th) {
            logger()->info("Register Gagal : $th");
            return back()->withErrors(['name', 'usernamme', 'email']);
        }
    }
}
