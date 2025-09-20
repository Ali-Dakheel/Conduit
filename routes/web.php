<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Logout;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/profile/{author:name}', [ProfileController::class, 'show']);


Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/register', RegisterController::class);
    Route::view('/register', 'auth.register')->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', Logout::class)->middleware('auth')->name('logout');
    Route::post('/articles/{article:slug}/favorite',[ArticleController::class,'favorite']);
    Route::delete('/articles/{article:slug}/favorite',[ArticleController::class,'unfavorite']);
});


