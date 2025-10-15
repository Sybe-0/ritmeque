<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LibrariesController extends Controller
{
    // public function index()
    // {
    //     // $datalibrary = DB::select('SELECT * FROM libraries WHERE users_id = ?', [$userId]);
    //     $userId = Auth::id();
    //     $datalibrary = Library::where('users_id', $userId)->get();
    //     return view('home.all_libraries', compact('datalibrary'));
    //     // dd($datalibrary, collect($data)->toArray());
    // }

    public function findLibrary(Request $request)
    {
        // $idLibrary = $request->id;
        // $library = DB::select('SELECT * from libraries where id = ? LIMIT 1', [$idLibrary]);
        // return response()->json($library[0]);
        $library = Library::find($request->id);
        if ($library) {
            $library->viewed_at = Carbon::now();
        }
        $library->save();
        return response()->json($library);
    }

    public function favBtn(Request $request)
    {
        $fav = Library::find($request->id);
        $fav->is_favorite = $fav->is_favorite == 0 ? 1 : 0;
        $fav->save();
        return response()->json($fav);
    }

    public function createLibrary(Request $request)
    {
        $libraryAdd = $request->validate([
            'title' => 'required|string|max:40',
            'platform' => 'required',
            'description' => 'required|string',
        ]);

        $userId = Auth::user()->id;

        // $title = $request->input('title');
        // $description = $request->input('description');
        // $platform = $request->input('platform');
        // $insert = DB::insert('INSERT into libraries (title, description, platform, users_id, create_at, update_at) values (?, ?, ?, ?, NOW(), NOW())', [$title, $description, $platform, $userId]);

        $libraryAdd['users_id']=$userId;
        Library::create($libraryAdd);
        return redirect('/')->with('Succes', 'Library has created!');
    }

    public function updateLibrary(Request $request)
    {
        $editLibrary = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'libraries_id' => 'required',
        ]);
        $editLibrary = Library::find($request->libraries_id);
        $editLibrary->title = $request->title;
        $editLibrary->description = $request->description;
        $editLibrary->save();
        return response()->json([
            'libraries' => $editLibrary->users_id,
        ]);

        // $title = $request->input('title');
        // $description = $request->input('description');
        // $idLibrary = $request->libraries_id;
        // $editLibrary = DB::update('UPDATE libraries set title = ?, description = ? where id = ?', [$title, $description, $idLibrary]);
        // if ($editLibrary) {
        //     return redirect('/home')->with('success', 'Library has updated!');
        // } else {
        //     return redirect('/')->with('error', 'Error to update the library');
        // }
    }

    public function destroyLibrary(Request $request)
    {
        $request->validate([
            'libraries_id' => 'required',
        ]);
        // $idLibrary = $request->libraries_id;
        // DB::delete('DELETE from libraries where id = ?', [$idLibrary]);
        // dd($library);

        $idLibrary = Library::find($request->libraries_id);
        $idLibrary->delete();
        return redirect('/');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        if ($query) {
            $search = Library::where('title', 'LIKE', "%$query%")->get();
        } else {
            $search = collect();
        }
        return response()->json($search);
    }

    // public function testGetId($id) {
    //     dd($id);
    // }
}
