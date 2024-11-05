<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login atau redirect ke home jika sudah login.
     */
    public function login()
    {
        if (Auth::check()) { // Jika sudah login, redirect ke halaman home
            return redirect('/');
        }
        return view('auth.login');
    }

     /**
     * Proses login user.
     */
    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');
            
            // Coba melakukan login dengan credentials yang diberikan
            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            }

            // Jika login gagal
            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }

        return redirect('login');
    }

    /**
     * Logout user dan hapus session.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user

        // Invalidasi session dan generate ulang token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('login');
    }

    /**
     * Register.
     */
    public function register()
    {
        $levels = \App\Models\LevelModel::all(); // Mengambil semua data level dari tabel m_level
        return view('auth.register', compact('levels')); // Mengirim data levels ke view
    }


    /**
     * Proses Register.
     */
    public function postregister(Request $request)
    {
            // Validasi input dari form
            $validatedData = $request->validate([
                'username' => 'required|string|max:20|unique:m_user',
                'name' => 'required|string|max:100',
                'password' => 'required|string|min:5|confirmed',
                'level_id' => 'required|integer'
            ]);
    
            // Simpan data user ke database
            $user = new UserModel();
            $user->username = $validatedData['username'];
            $user->nama = $validatedData['name'];
            $user->password = Hash::make($validatedData['password']);
            $user->level_id = $validatedData['level_id'];
            $user->save();
    
            // Redirect ke halaman login setelah registrasi
            return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

}
