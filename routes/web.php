<?php

use App\Models\Post;
use App\Models\Library;
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
Route::post('/home/library', [LobbyController::class, 'library']);
Route::post('/home/logout', [LobbyController::class, 'logout'])->middleware('auth');
Route::redirect('/', '/home', 301);

Route::get('password/reset', [ResetController::class, 'index']);
Route::post('password/email', [ResetController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);