<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Library;
use App\Models\Playlist;
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

    public function searchLibrary(Request $request)
    {
        $datalibrary = Library::findOrFail($request->id);
        return response()->json($datalibrary);
    }

    public function searchPlaylist(Request $request)
    {
        $dataplaylist = Playlist::where('libraries_id', $request->id)->get();
        return response()->json($dataplaylist);
    }

    public function searchPlaylistFetch(Request $request)
    {
        $test = Playlist::where('id', $request->id)->first();
        return response()->json($test);
    }
    
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/home');
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

    public function updateLibrary(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'libraries_id' => 'required',
        ]);
        $editId = Library::find($request->libraries_id);
        $editId->title = $request->title;
        $editId->description = $request->description;
        $editId->save();
        return redirect('/');
    }

    public function playlist(Request $request)
    {
        $playlistAdd = $request->validate([
            'songs' => 'required|string',
            'url_link' => 'required|string|url',
            'libraries_id' => 'required',
        ]);
        Playlist::create($playlistAdd);
        return redirect('/home');
    }

    public function updatePlaylist(Request $request)
    {
        $request->validate([
            'songs' => 'required',
            'url_link' => 'required',
            'playlist_id' => 'required',
        ]);
        $playlist = Playlist::find($request->playlist_id);
        $playlist->songs = $request->songs;
        $playlist->url_link = $request->url_link;
        $playlist->save();
        return redirect('/');
    }
    
    public function destroyLibrary(Request $request)
    {
        $deletelibrary = $request->validate([
            'libraries_id' => 'required',
        ]);
        $library = Library::find($request->libraries_id);
        $library->delete();
        return redirect('/home');
    }

    public function destroyPlaylist(Request $request)
    {
        $request->validate([
            'playlist_id' => 'required',
        ]);
        $playlist = Playlist::find($request->playlist_id);
        $playlist->delete();
        return redirect('/');
    }

    // public function testGetId($id) {
    //     dd($id);
    // }
}
