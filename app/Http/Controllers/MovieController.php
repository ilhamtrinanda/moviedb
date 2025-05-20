<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MovieController extends Controller
{
    public function homepage()
    {
        $movies = Movie::latest()->paginate(6);
        return view('homepage', compact('movies'));
    }

    public function detail($id, $slug){
        $movie = Movie::find($id);
        return view('detailmovie', compact('movie'));
    }
}
