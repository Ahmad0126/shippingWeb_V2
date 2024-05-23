<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logins extends Controller
{
    public function login_index(){
        return view('login');
    }
    public function auth_user(Request $req):RedirectResponse{
        $user = $req->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($user)){
            $req->session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors([
            'username' => 'Login Failed!'
        ])->onlyInput('username');
    }
    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/login');
    }
}
