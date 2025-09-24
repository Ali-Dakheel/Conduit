<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('article.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'tags' => 'array',
            'description' => 'required',
        ]);

        $slug = Str::slug($validated['title']) . '-' . uniqid();

        $article = auth()->user()->articles()->create([
            'title' => $validated['title'],
            'slug' => $slug,
            'body' => $validated['body'],
            'description' => $validated['description'],
        ]);
        $article->tags()->attach($validated['tags']);

        return redirect()->route('article.show', $article->slug)
            ->with('message', 'Article created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->load([
            'author' => function ($query) {
                $query->withCount('followers');
            },
            'tags',
            'comments.author'
        ])->loadCount(['comments', 'favorites']);

        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function favorite(Article $article)
    {
        auth()->user()->favoriteArticles()->syncWithoutDetaching([$article->id]);
        return back()->with('message', 'Article favorited!');
    }

    public function unfavorite(Article $article)
    {
        auth()->user()->favoriteArticles()->detach($article->id);
        return back()->with('message', 'Article unfavorited!');
    }
}
