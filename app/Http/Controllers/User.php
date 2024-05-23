<?php

namespace App\Http\Controllers;

use App\Models\MyUser as ModelsUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class User extends Controller
{
    public function show(){
        $data['title'] = 'Daftar User';
        $data['users'] = ModelsUser::all();
        return view('users', $data);
    }

    public function store(Request $req){
        $user = new ModelsUser();
        
        $user->username = $req->username;
        $user->nama = $req->nama;
        $user->password = md5($req->password);
        $user->level = $req->level;
        $user->kota = $req->kota;
        $user->telp = $req->telp;

        $user->save();

        return redirect('/user');
    }

    public function update(Request $req){
        $user = ModelsUser::find($req->id_user);

        $user->nama = $req->nama;
        $user->level = $req->level;
        $user->kota = $req->kota;
        $user->telp = $req->telp;

        $user->save();

        return redirect('/user');
    }
    
    public function reset(Request $req){
        foreach($req->id_user as $id){
            $user = ModelsUser::find($id);
            $user->password = md5('12345678');
            $user->save();
        }

        return redirect('/user');
    }
    
    public function delete(Request $req){
        ModelsUser::destroy($req->id_user);
        return redirect('/user');
    }
}
