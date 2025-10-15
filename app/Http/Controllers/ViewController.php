<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;
use App\Models\Library;

class ViewController extends Controller
{
    public function allLibraries()
    {
        $users = Auth::id();
        $datalibrary = Library::where('users_id', $users)->get();
        if (Agent::isMobile()) {
            return view('home.mobile_all_libraries', compact('datalibrary'));
        } else {
            return view('home.all_libraries', compact('datalibrary'));
        }
    }

    public function signup()
    {
        if (Agent::isMobile()) {
            return view('');
        } else {
            return view('auth.register');
        }
    }

    public function signin()
    {
        if (Agent::isMobile()) {
            return view('');
        } else {
            return view('auth.login');
        }
    }

    public function viewFavorite()
    {
        $favorite = Library::where('is_favorite', '1')->get();
        return view('home.favorite', compact('favorite'));
    }

    public function viewRecently()
    {
        $recently = Library::orderBy('viewed_at', 'desc')->take(5)->get();
        return view('home.recently', compact('recently'));
    }
}
