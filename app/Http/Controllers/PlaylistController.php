<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function findPlaylist(Request $request)
    {
        // $idPlaylist = $request->id;
        // $dataplaylist = DB::select('SELECT * from playlist_songs where libraries_id = ?', [$idPlaylist]);
        // return response()->json($dataplaylist);
        $dataplaylist = Playlist::where('libraries_id', $request->id)->get();
        return response()->json($dataplaylist);
    }

    public function findPlaylistFetch(Request $request)
    {
        // $idFetch = $request->id;
        // $fetch = DB::select('SELECT * from playlist_songs where id = ? LIMIT 1', [$idFetch]);
        // return response()->json($fetch[0]);
        $fetch = Playlist::where('id', $request->id)->first();
        return response()->json($fetch);
    }

    public function createPlaylist(Request $request)
    {
        $playlistAdd = $request->validate([
            'songs' => 'required|string',
            'url_link' => 'required|string|url',
            'libraries_id' => 'required',
        ]);
        // $songs = $request->input('songs');
        // $link = $request->input('url_link');
        // $libraries = $request->input('libraries_id');
        // $result = DB::insert('INSERT into playlist_songs (songs, url_link, libraries_id, create_at, update_at) values (?, ?, ?, NOW(), NOW())', [$songs, $link, $libraries]);

        // dd($result);

        $playlist = Playlist::create($playlistAdd);
        return response()->json($playlist);
    }

    public function updatePlaylist(Request $request)
    {
        $request->validate([
            'songs' => 'required',
            'url_link' => 'required',
            'playlist_id' => 'required',
        ]);
        // $songs = $request->input('songs');
        // $link = $request->input('url_link');
        // $idPlaylist = $request->playlist_id;
        // DB::update('UPDATE playlist_songs set songs = ?, url_link = ? where id = ?', [$songs, $link, $idPlaylist]);

        $playlist = Playlist::find($request->playlist_id);
        $playlist->songs = $request->songs;
        $playlist->url_link = $request->url_link;
        $playlist->save();
        return response()->json($playlist);
    }

    public function destroyPlaylist(Request $request)
    {
        $request->validate([
            'playlist_id' => 'required',
        ]);
        // $idPlaylist = $request->playlist_id;
        // DB::delete('DELETE from playlist_songs where id = ?', [$idPlaylist]);

        $idPlaylist = Playlist::find($request->playlist_id);
        $idPlaylist->delete();
        return response()->json($idPlaylist);
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array|min:1',
            'order.*' => 'required|integer'
        ]);

        $orderId = $request->input('order');
        $orderValue = 1;

        try {
            DB::transaction(function () use ($orderId, $orderValue) {
                foreach ($orderId as $itemId) {
                    Playlist::where('id', $itemId)->update(['order' => $orderValue]);
                    $orderValue++;
                }
            });
            return response()->json([
                'success' => true,
                'order' => $orderId
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load: ' . $e->getMessage()
            ], 500);
        }
    }
}
