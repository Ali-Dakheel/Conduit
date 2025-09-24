<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::getArticlesFiltered($request->get('tag'));
        $tags = Tag::getPopularTags();
        $myArticles = Article::all()->where('author_id',auth()->id());
        return view('welcome', compact('articles', 'tags', 'myArticles'));
    }
}
