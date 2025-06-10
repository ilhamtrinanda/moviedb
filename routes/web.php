<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\RoleAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'homepage']);
Route::get('movie/{id}/{slug}', [MovieController::class, 'detail']);
Route::get('/create_movie', [MovieController::class, 'create'])->name('createMovie')->middleware('auth');
Route::post('/movie', [MovieController::class, 'store'])->middleware('auth');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/data-movie', [MovieController::class, 'dataMovie'])
    ->middleware('auth')
    ->name('movies.index');
Route::get('/editmovie/{id}', [MovieController::class, 'edit'])->middleware('auth', RoleAdmin::class);
Route::post('/movie-delete/{id}', [MovieController::class, 'delete'])->name('movie.delete')->middleware('auth');
Route::put('/movies/{id}', [MovieController::class, 'update'])->name('movies.update');
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index')->middleware('auth');
