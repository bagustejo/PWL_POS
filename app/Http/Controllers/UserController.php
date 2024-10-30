<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        /*
        // Tambah data user dengan Eloquent Model
        $data = [
            'level_id' => 2,
            'username' => 'manager_tiga',
            'nama' => 'Manager 3',
            'password' => Hash::make('12345')
        ];
        UserModel::create($data); // tambah ke m_user
        */

        //coba akses user model
        $user = UserModel::with('level')->get(); //amnbil semua data dari m_user
        return view('user', ['data', 'data' => $user] );
        

        /*$user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager 11',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);

        $user->username = 'manager12';
        $user->save();

        $user->wasChanged(); // true
        $user->wasChanged('username'); // true
        $user->wasChanged(['username', 'level_id']); // true
        $user->wasChanged('nama'); // false
        dd($user->wasChanged(['nama', 'username'])); // true
        */
    }

    public function tambah(){
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request){

        UserModel::create([
            'username' => $request -> username,
            'nama' => $request -> nama,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->level_id
        ]);

        return redirect('/user');
    }

    public function ubah($id){
        $user = UserModel::find($id);
        return view ('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request){
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect(('/user'));
    }

    public function hapus($id){
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }
    


}


