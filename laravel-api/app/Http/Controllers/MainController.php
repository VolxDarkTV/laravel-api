<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model
use App\Models\Movie;

class MainController extends Controller
{
    public function home(){

        $movies = Movie::all();

        return view('pages.home', compact('movies'));
    }
}
