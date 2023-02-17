<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Tag;

class ApiController extends Controller
{
    public function movie()
    {   
        $movies = Movie::all();
        $genres = Genre::all();
        $tags = Tag::all();

        return response() -> json([
            'success' => true,
            'response' => [
                'movies' => $movies,
                'genres' => $genres,
                'tags' => $tags,
            ]
        ]);
    }

    public function movieStore(Request $request){

        $data = $request -> all();

        // Genre
        $movie = Movie::make($data);
        $genre = Genre::find($data['genre_id']);

        $movie -> genre() -> associate($genre);
        $movie -> save();

        // Tag
        $tags = Tag::find($data['tags_id']);
        $movie -> tags() -> attach($tags);

        return response() -> json([
            'success' => true,
            'response' => $movie,
        ]);
    }

    public function movieDelete(Movie $movie){
        $movie -> tags() -> sync([]);
        $movie -> delete();

        return response() -> json([
            'success' => true,

        ]);
    }
}
