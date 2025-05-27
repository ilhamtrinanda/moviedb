<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function homepage()
    {
        $movies = Movie::latest()->paginate(6);
        return view('homepage', compact('movies'));
    }

    public function detail($id, $slug)
    {
        $movie = Movie::find($id);
        return view('detailmovie', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('create_movie', compact('categories'));
    }

    public function store(Request $request)
    {
        //ambil semua inputan dari form
        $validated = $request->validate(
            [
                'title' => 'required|string|max:255',
                'synopsis' => 'nullable|string',
                'category_id' => 'required|exists:categories,id',
                'year' => 'required | integer | min:1950 | max:' . date('Y'),
                'actors' => 'required|string',
                'cover_image' => 'nullable|image|mimes:jpg,jpeg,webp,png'
            ]
        );

        $slug = Str::slug($request->title);

        //ambil input file  dan simpan ke storage
        $cover = null;
        if ($request->hasFile('cover_image')) {
            $cover = $request->file('cover_image')->store('covers', 'public');
        }

        //simpan ke tabel movies
        Movie::create(
            [
                'title' => $validated['title'],
                'slug' => $slug,
                'synopsis' => $validated['synopsis'],
                'category_id' => $validated['category_id'],
                'year' => $validated['year'],
                'actors' => $validated['actors'],
                'cover_image' => $cover,
            ]
        );

        return redirect('/')->with('success', 'Movie save successfully');
    }
}
