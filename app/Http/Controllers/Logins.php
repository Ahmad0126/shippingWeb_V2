<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class Logins extends Controller
{
    public function login_index(){
        return view('login');
    }
    public function login_kantor(){
        return view('masuk_kantor');
    }
    public function password(){
        return view('password');
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
    public function ganti_password(Request $req){
        $req->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
            'password_konfirmasi' => 'required'
        ]);

        if (! Hash::check($req->password_lama, $req->user()->password)) {
            return back()->withErrors([
                'password' => ['Password lama salah!']
            ]);
        }
        if($req->password_baru != $req->password_konfirmasi){
            return back()->withErrors([
                'password' => ['Konfirmasi kembali password baru']
            ]);
        }

        $u = User::find(auth()->user()->id);
        $u->password = Hash::make($req->password_baru);
        $u->save();
        return redirect()->intended();
    }
    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/login');
    }
}
