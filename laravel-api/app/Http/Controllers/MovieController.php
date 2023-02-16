<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model
use App\Models\Movie;
use App\Models\Tag;
use App\Models\Genre;

class MovieController extends Controller
{
    // Show
    public function movieShow(Movie $movie){
        return view('pages.movie.movie-show', compact('movie'));
    }

    // Create
    public function movieCreate(){

        $genres = Genre::all();
        $tags = Tag::all();

        return view('pages.movie.movie-create', compact('genres', 'tags'));
    }
    // Store
    public function movieStore(Request $request){

        $data = $request -> validate([
            'name' => 'required|string',
            'year' => 'required|integer',
            'cashOut' => 'nullable|integer',
            'genre_id' => 'required|string',
            'tags_id' => 'required|array'
        ]);

        // Genre
        $movie = Movie::make($data);
        $genre = Genre::find($data['genre_id']);

        $movie -> genre() -> associate($genre);
        $movie -> save();

        // Tag
        $tags = Tag::find($data['tags_id']);
        $movie -> tags() -> attach($tags);

        return redirect() -> route('home');
        
    }

    // Edit
    public function movieEdit(Movie $movie){
        $genres = Genre::all();
        $tags = Tag::all();

        return view('pages.movie.movie-edit', 
            compact('movie', 'genres', 'tags'));
    }
    // Update
    public function movieUpdate(Request $request, Movie $movie){
        
        $data = $request -> validate([
            'name' => 'required|string',
            'year' => 'required|integer',
            'cashOut' => 'nullable|integer',
            'genre_id' => 'required|string',
            'tags_id' => 'required|array'
        ]);

        // Genre
        $movie -> update($data);
        $genre = Genre::find($data['genre_id']);

        $movie -> genre() -> associate($genre);
        $movie -> save();

        // Tag
        $tags = Tag::find($data['tags_id']);
        $movie -> tags() -> sync($tags);

        return redirect() -> route('home');
    }

    // Delete
    public function movieDelete(Movie $movie){
        $movie -> tags() -> sync([]);
        $movie -> delete();

        return redirect() -> route('home');
    }
}
