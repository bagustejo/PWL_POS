<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
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
        
        //coba akses user model
        $user = UserModel::all(); //amnbil semua data dari m_user
        return view('user', ['data' => $user]);
        */

        $user = UserModel::findOr (20, ['username', 'nama'], function() {
            abort(404);
        });

        return view('user', ['data'=> $user]);
    }
}
