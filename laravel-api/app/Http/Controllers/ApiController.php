<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model
use App\Models\Movie;

class ApiController extends Controller
{
    public function movie()
    {   
        $movies = Movie::all();

        return response() -> json([
            'success' => true,
            'response' => $movies,
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
