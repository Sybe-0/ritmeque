<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LobbyController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $datalibrary = Library::where('users_id', $userId)->get();
        return view('redirect.lobby', compact('datalibrary'));
    }

    public function show(Request $request)
    {
        $datalibrary = Library::findOrFail($request->id);
        return response()->json($datalibrary);
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

        $userId = Auth::user()->id;

        $libraryAdd['users_id']=$userId;

        Library::create($libraryAdd);

        return redirect('/home');
    }
}
