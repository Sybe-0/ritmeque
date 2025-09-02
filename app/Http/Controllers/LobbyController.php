<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Library;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LobbyController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $datalibrary = DB::select('SELECT * FROM libraries WHERE users_id = ?', [$userId]);
        // $data = Library::where('users_id', $userId)->get();
        // dd($datalibrary, collect($data)->toArray());
        return view('redirect.lobby', compact('datalibrary'));
    }

    public function findLibrary(Request $request)
    {
        $idLibrary = $request->id;
        $library = DB::select('SELECT * from libraries where id = ? LIMIT 1', [$idLibrary]);
        return response()->json($library[0]);
        // $datalibrary = Library::findOrFail($request->id);
    }

    public function findPlaylist(Request $request)
    {
        $idPlaylist = $request->id;
        $dataplaylist = DB::select('SELECT * from playlist_songs where libraries_id = ?', [$idPlaylist]);
        return response()->json($dataplaylist);
        // $dataplaylist = Playlist::where('libraries_id', $request->id)->get();
    }

    public function findPlaylistFetch(Request $request)
    {
        $idFetch = $request->id;
        $fetch = DB::select('SELECT * from playlist_songs where id = ? LIMIT 1', [$idFetch]);
        return response()->json($fetch[0]);
        // $test = Playlist::where('id', $request->id)->first();
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/home');
    }

    public function createLibrary(Request $request)
    {
        $libraryAdd = $request->validate([
            'title' => 'required|string|max:40',
            'platform' => 'required',
            'description' => 'required|string',
        ]);

        $userId = Auth::user()->id;

        $libraryAdd['users_id']=$userId;

        $title = $request->input('title');
        $description = $request->input('description');
        $platform = $request->input('platform');

        $insert = DB::insert('INSERT into libraries (title, description, platform, users_id, create_at, update_at) values (?, ?, ?, ?, NOW(), NOW())', [$title, $description, $platform, $userId]);
        // dd($insert);
        // Library::create($libraryAdd);
        return redirect('/home')->with('Succes', 'Library has created!');
    }

    public function updateLibrary(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'libraries_id' => 'required',
        ]);
        // $editLibrary = Library::find($request->libraries_id);
        // $editLibrary->title = $request->title;
        // $editLibrary->description = $request->description;
        // $editId->save();

        $title = $request->input('title');
        $description = $request->input('description');
        $idLibrary = $request->libraries_id;
        $editLibrary = DB::update('UPDATE libraries set title = ?, description = ? where id = ?', [$title, $description, $idLibrary]);
        if ($editLibrary) {
            return redirect('/home')->with('success', 'Library has updated!');
        } else {
            return redirect('/')->with('error', 'Error to update the library');
        }
        // dd();
    }

    public function createPlaylist(Request $request)
    {
        $playlistAdd = $request->validate([
            'songs' => 'required|string',
            'url_link' => 'required|string|url',
            'libraries_id' => 'required',
        ]);
        $songs = $request->input('songs');
        $link = $request->input('url_link');
        $libraries = $request->input('libraries_id');
        $result = DB::insert('INSERT into playlist_songs (songs, url_link, libraries_id, create_at, update_at) values (?, ?, ?, NOW(), NOW())', [$songs, $link, $libraries]);
        // dd($result);

        // Playlist::create($playlistAdd);
        return redirect('/home');
    }

    public function updatePlaylist(Request $request)
    {
        $request->validate([
            'songs' => 'required',
            'url_link' => 'required',
            'playlist_id' => 'required',
        ]);
        $songs = $request->input('songs');
        $link = $request->input('url_link');
        $idPlaylist = $request->playlist_id;
        DB::update('UPDATE playlist_songs set songs = ?, url_link = ? where id = ?', [$songs, $link, $idPlaylist]);

        // $playlist = Playlist::find($request->playlist_id);
        // $playlist->songs = $request->songs;
        // $playlist->url_link = $request->url_link;
        // $playlist->save();
        return redirect('/');
    }

    public function destroyLibrary(Request $request)
    {
        $request->validate([
            'libraries_id' => 'required',
        ]);
        $idLibrary = $request->libraries_id;
        DB::delete('DELETE from libraries where id = ?', [$idLibrary]);
        // dd($library);

        // $library = Library::find($request->libraries_id);
        // $library->delete();
        return redirect('/home');
    }

    public function destroyPlaylist(Request $request)
    {
        $request->validate([
            'playlist_id' => 'required',
        ]);
        $idPlaylist = $request->playlist_id;
        DB::delete('DELETE from playlist_songs where id = ?', [$idPlaylist]);

        // $playlist = Playlist::find($request->playlist_id);
        // $playlist->delete();
        return redirect('/');
    }

    // public function testGetId($id) {
    //     dd($id);
    // }
}
