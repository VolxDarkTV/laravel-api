<?php

use Illuminate\Support\Facades\Route;
// Controller
use App\Http\Controllers\MainController;
use App\Http\Controllers\MovieController;

Route::get('/', [MainController::class, 'home'])
    -> name('home');

    // Show
Route::get('/movie/show/{movie}', [MovieController::class, 'movieShow'])
    -> name('movie.show');

    // Create
Route::get('/movie/create', [MovieController::class, 'movieCreate'])
    -> name('movie.create');
    // Store
Route::post('/movie/store', [MovieController::class, 'movieStore'])
    -> name('movie.store');

    // Edit
Route::get('/movie/edit/{movie}', [MovieController::class, 'movieEdit'])
    -> name('movie.edit');
    // Update
Route::post('/movie/update/{movie}', [MovieController::class, 'movieUpdate'])
    -> name('movie.update');
    // Delete
Route::get('/movie/delete/{movie}', [MovieController::class, 'movieDelete'])
    -> name('movie.delete');



