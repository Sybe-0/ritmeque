<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function create()
    {
        return view('signup.create');
    }
    public function store(Request $request)
    {

        $validateUser = $request->validate([
            'username' => 'required|string|min:3|max:255|unique:users,email',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:5|max:25'
        ]);

        $username = $request->input('username');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $test = DB::insert('INSERT into users (username, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())', [$username, $email, $password]);

        // $validateUser['password'] = Hash::make($validateUser['password']);
        // User::create($validateUser);
        // dd();
        return redirect('/signin')->with('success', 'Registrasi Berhasil! Coba login untuk memastikan akun.');
    }
}
