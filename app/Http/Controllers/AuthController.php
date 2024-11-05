<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

}
