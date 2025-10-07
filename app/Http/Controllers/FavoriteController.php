<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function view()
    {
        $favorite = Library::where('is_favorite', '1')->get();
        return view('home.favorite', compact('favorite'));
    }
}
