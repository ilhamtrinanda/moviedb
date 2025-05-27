<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'homepage']);
Route::get('movie/{id}/{slug}', [MovieController::class, 'detail']);
Route::get('create_movie', [MovieController::class, 'create'])->name('createMovie');
Route::post('/movie',[MovieController::class, 'store']);
