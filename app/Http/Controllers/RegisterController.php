<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        //enkripsi password
        $validateUser['password'] = Hash::make($validateUser['password']);

        User::create($validateUser);

        return redirect('/home')->with('success', 'Registrasi Berhasil! Coba login untuk memastikan akun.');
    }
}
