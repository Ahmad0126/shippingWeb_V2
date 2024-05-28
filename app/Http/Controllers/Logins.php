<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logins extends Controller
{
    public function login_index(){
        return view('login');
    }
    public function login_kantor(){
        return view('masuk_kantor');
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
    public function auth_kantor(Request $req){
        $cabang = Cabang::where('kode_cabang', $req->kode_cabang)->get();
        if($cabang->first() == null){
            return redirect(route('login_kantor'))->withErrors(['err_kantor' => 'Kode kantor tidak terdaftar!']);
        }

        session(['kantor' => $cabang->first()]);
        return redirect('/');
    }
    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/login');
    }
}
