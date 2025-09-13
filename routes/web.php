<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $query = \App\Models\Article::with('author','tags')->withCount(['comments', 'favorites']);
    if (request()->get('tag')) {
        $query->whereHas('tags', function($q) {
            $q->where('name', request()->get('tag'));
        });
    }
    $articles = $query->latest()->paginate(9);
    $tags = \App\Models\Tag::all()->pluck('name');
    return view('welcome', compact('tags','articles'));
});

Route::get('/login', function () {
    return view('auth.login');
});

