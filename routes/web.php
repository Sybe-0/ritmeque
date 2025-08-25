<?php

use App\Models\Post;
use App\Models\Library;
use App\Models\Playlist;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LobbyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\RegisterController;

Route::get('/signup', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/signup', [RegisterController::class, 'store']);

Route::get('/signin', [LoginController::class, 'index'])->middleware('guest');
Route::post('/signin', [LoginController::class, 'authenticate']);

Route::get('/home', [LobbyController::class, 'index']);
Route::post('/home/library', [LobbyController::class, 'library'])->middleware('auth');
Route::post('/home/edit/library', [LobbyController::class, 'updateLibrary']);
Route::post('/home/playlist', [LobbyController::class, 'playlist']);
Route::post('/home/edit/playlist', [LobbyController::class, 'updatePlaylist']);
Route::post('/logout', [LobbyController::class, 'logout'])->middleware('auth');
Route::redirect('/', '/home', 301);

Route::post('/library/delete', [LobbyController::class, 'destroyLibrary'])->name('library.delete');
Route::post('/playlist/delete', [LobbyController::class, 'destroyPlaylist'])->name('library.delete');

Route::get('/library/find', [LobbyController::class, 'searchLibrary']);
Route::get('/library/playlist/find', [LobbyController::class, 'searchPlaylist']);
Route::get('/playlist/find', [LobbyController::class, 'searchPlaylistFetch']);

Route::get('password/reset', [ResetController::class, 'index']);
Route::post('password/email', [ResetController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

// Route::get('/library/test/{id}', [LobbyController::class, 'testGetId'])->name('test-library');