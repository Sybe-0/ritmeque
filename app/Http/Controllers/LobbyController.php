<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LobbyController extends Controller
{
    public function index()
    {
        return view ('redirect.lobby');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function library(Request $request)
    {
        $libraryAdd = $request->validate([
            'title' => 'required|string|max:40',
            'platform' => 'required',
            'description' => 'string',
        ]);

        // dd($libraryAdd);
        Library::create($libraryAdd);

        return redirect('/home');
    }
}
