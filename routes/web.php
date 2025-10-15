<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LibrariesController;
use App\Http\Controllers\ViewController;

Route::get('/home', [ViewController::class, 'allLibraries']);
Route::get('/signup', [ViewController::class, 'signup'])->middleware('guest');
Route::get('/signin', [ViewController::class, 'signin'])->middleware('guest');
Route::get('/home/favorite', [ViewController::class, 'viewFavorite']);
Route::get('/home/recently', [ViewController::class, 'viewRecently']);

Route::post('/signup', [RegisterController::class, 'create']);
Route::post('/signin', [LoginController::class, 'authenticate']);
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout.btn');

Route::get('/library/find', [LibrariesController::class, 'findLibrary']);
Route::get('/home/library/search', [LibrariesController::class, 'search'])->name('search.library');
Route::post('/home/library', [LibrariesController::class, 'createLibrary'])->middleware('auth');
Route::post('/home/edit/library', [LibrariesController::class, 'updateLibrary'])->name('upd.library');
Route::post('/library/delete', [LibrariesController::class, 'destroyLibrary'])->name('library.delete');
Route::get('library/favbtn', [LibrariesController::class, 'favBtn'])->name('favorite.btn');

Route::post('/home/playlist', [PlaylistController::class, 'createPlaylist'])->name('add.playlist');
Route::post('/home/edit/playlist', [PlaylistController::class, 'updatePlaylist'])->name('upd.playlist');
Route::post('/playlist/delete', [PlaylistController::class, 'destroyPlaylist'])->name('del.playlist');
Route::post('/playlist/order', [PlaylistController::class, 'updateOrder']);
Route::get('/library/playlist/find', [PlaylistController::class, 'findPlaylist']);
Route::get('/playlist/find', [PlaylistController::class, 'findPlaylistFetch']);

Route::get('password/reset', [ResetController::class, 'index']);
Route::post('password/email', [ResetController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

Route::redirect('/', '/home', 301);
