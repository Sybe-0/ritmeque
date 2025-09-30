<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function signin()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // $username = $request->input('username');
        // $password = $request->input('password');
        // $remember = $request->has('remember');

        // $user = DB::select('SELECT * from users where username = ?', [$username]);

        // if ($user) {
        //     $user = $user[0];

        //     if (password_verify($password, $user->password)) {
        //         if (Auth::attempt($credentials, $remember)) {
        //             $request->session(['users_id' => $user->id])->regenerate();
        //             return redirect()->intended('/');
        //         }
        //         // return response()->json(['massage' => 'Login berhasil', 'user' => $user]);
        //     } else {
        //         return response()->json(['massage' => 'Password tidak ditemukan'], 401);
        //     }
        // } else {
        //     return response()->json(['massage' => 'User tidak ditemukan'], 404);
        // }

        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return redirect()->back()->withErrors([
            'email' => 'Email salah!',
        ]);
    }
}
