<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class RecentlyController extends Controller
{
    public function viewRecently()
    {
        $recently = Library::orderBy('viewed_at', 'desc')->take(5)->get();
        return view('home.recently', compact('recently'));
    }
}
