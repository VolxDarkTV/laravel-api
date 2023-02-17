<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controller
use App\Http\Controllers\ApiController;


Route::get('/v1/movie', [ApiController::class, 'movie']);

Route::get('/v1/movie/delete/{movie}', [ApiController::class, 'movieDelete']);