<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'body', 'slug'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'article_favorite');
    }

    public static function getArticlesFiltered(?string $tag = null)
    {
        $query = static::with('author', 'tags')->withCount(['comments', 'favorites']);
        if ($tag) {
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('name', $tag);
            });
        }
        return $query->latest()->paginate(9)->withQueryString();
    }
}
