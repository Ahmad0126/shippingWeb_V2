<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    public function show(){
        $data['title'] = 'Daftar User';
        $data['users'] = ModelsUser::orderBy('id', 'desc')->get();
        return view('users', $data);
    }

    public function store(Request $req){
        $req->validate([
            'username' => 'unique:user,username|max:25|required',
            'nama' => 'required|max:60',
            'password' => 'required|min:4',
            'level' => 'required',
            'kota' => 'required|max:30',
            'telp' => 'nullable|numeric|max_digits:15'
        ]);

        $user = new ModelsUser();
        $user->username = $req->username;
        $user->nama = $req->nama;
        $user->password = Hash::make($req->password);
        $user->level = $req->level;
        $user->kota = $req->kota;
        $user->telp = $req->telp;

        $user->save();

        return redirect()->route('user')->with('notif', 'Berhasil menambahkan user');
    }

    public function update(Request $req){
        $req->validate([
            'nama' => 'required|max:60',
            'level' => 'required',
            'kota' => 'required|max:30',
            'telp' => 'nullable|numeric|max_digits:15'
        ]);

        $user = ModelsUser::find($req->id_user);
        $user->nama = $req->nama;
        $user->level = $req->level;
        $user->kota = $req->kota;
        $user->telp = $req->telp;

        $user->save();

        return redirect()->route('user')->with('notif', 'Berhasil Mengedit user');
    }
    
    public function reset(Request $req){
        foreach($req->id_user as $id){
            $user = ModelsUser::find($id);
            $user->password = Hash::make('12345678');
            $user->save();
        }

        return redirect()->route('user')->with('notif', 'Berhasil mereset user');
    }
    
    public function delete(Request $req){
        ModelsUser::destroy($req->id_user);
        return redirect()->route('user')->with('notif', 'Berhasil menghapus user');
    }
}
