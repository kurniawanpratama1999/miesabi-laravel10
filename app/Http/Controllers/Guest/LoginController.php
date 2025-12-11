<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index () {
        $logo = Logo::first();
        return view('pages.guest.login', compact('logo'));
    }

    public function login (Request $req) {
        $validate = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if(Auth::attempt($validate)) {
            $req->session()->regenerate();
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('a.products.index');
            }

            if ($user->role === 'user') {
                return redirect()->route('u.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Email atau Password Salah', 'password' => 'Email atau Password Salah'])->onlyInput('email');
    }

    public function logout(Request $req)
    {
        Auth::logout();

        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect()->route('login');
    }
}
