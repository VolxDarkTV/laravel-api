<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model
use App\Models\Movie;

class ApiController extends Controller
{
    public function test()
    {   
        $movies = Movie::all();

        return response() -> json([
            'success' => true,
            'response' => $movies,
        ]);
    }
}
