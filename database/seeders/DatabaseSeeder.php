<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create tags with faker words
        $tags = Tag::factory()->count(10)->create();

        // Create users
        $users = User::factory()->count(5)->create();

        // Create articles and attach random tags
        Article::factory()->count(20)->create()->each(function ($article) use ($tags) {
            $article->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
        });
    }
}
