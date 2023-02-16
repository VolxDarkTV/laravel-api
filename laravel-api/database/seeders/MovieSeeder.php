<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Model
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Tag;
class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::factory()->count(100)->make()->each(function($p){
            // Genre
            $genre = Genre::inRandomOrder() -> first();
            $p -> genre() -> associate($genre);
            $p -> save();

            // Tags
            $tags = Tag::inRandomOrder() -> limit(5) -> get();
            $p -> tags() -> attach($tags);
        });
    }
}
