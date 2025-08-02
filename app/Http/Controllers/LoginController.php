<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Fascades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request){
        $authen = $request->validate([
            'name' => 'required|name',
            'password' => 'required'
        ]);

        if(Auth::attempt([$authen])) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        dd('done');
    }
}
