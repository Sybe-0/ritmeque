<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LobbyController;

Route::get('/signup', [RegisterController::class, 'create']);
Route::post('/signup', [RegisterController::class, 'store']);

Route::get('/signin', [LoginController::class, 'index']);
Route::post('/signin', [LoginController::class, 'authenticate']);

Route::get('/home', [LobbyController::class, 'index']);