<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LibrariesController;

Route::get('/signup', [RegisterController::class, 'signup'])->middleware('guest');
Route::post('/signup', [RegisterController::class, 'create']);
Route::get('/signin', [LoginController::class, 'signin'])->middleware('guest');
Route::post('/signin', [LoginController::class, 'authenticate']);
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout.btn');

Route::get('/home', [LibrariesController::class, 'index']);

Route::get('/library/find', [LibrariesController::class, 'findLibrary']);
Route::get('/home/library/search', [LibrariesController::class, 'search'])->name('search.library');
Route::post('/home/library', [LibrariesController::class, 'createLibrary'])->middleware('auth');
Route::post('/home/edit/library', [LibrariesController::class, 'updateLibrary'])->name('upd.library');
Route::post('/library/delete', [LibrariesController::class, 'destroyLibrary'])->name('library.delete');
Route::get('library/favbtn', [LibrariesController::class, 'favBtn'])->name('favorite.btn');

Route::post('/home/playlist', [PlaylistController::class, 'createPlaylist'])->name('add.playlist');
Route::post('/home/edit/playlist', [PlaylistController::class, 'updatePlaylist'])->name('upd.playlist');
Route::post('/playlist/delete', [PlaylistController::class, 'destroyPlaylist'])->name('del.playlist');
Route::get('/library/playlist/find', [PlaylistController::class, 'findPlaylist']);
Route::get('/playlist/find', [PlaylistController::class, 'findPlaylistFetch']);

Route::get('password/reset', [ResetController::class, 'index']);
Route::post('password/email', [ResetController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

Route::redirect('/', '/home', 301);
