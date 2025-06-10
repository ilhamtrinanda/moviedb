<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

    public function dataMovie()
    {
        $movies = Movie::latest()->paginate(10);
        return view('dataMovie', compact('movies'));
    }

    public function edit($id)
    {
        $movie = Movie::with('category')->findOrFail($id);
        $categories = Category::all(); // tambahkan agar dropdown kategori tidak kosong

        return view('edit', compact('movie', 'categories'));
    }
    public function delete($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie successfully deleted');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|digits:4',
            'synopsis' => 'required',
            'actors' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $movie = Movie::findOrFail($id);

        $imagePath = $movie->cover_image;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('posters', 'public');
        }

        $movie->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'synopsis' => $request->synopsis,
            'category_id' => $request->category_id,
            'year' => $request->year,
            'actors' => $request->actors,
            'cover_image' => $imagePath,
        ]);

        // Redirect ke halaman data movie
        return redirect('/data-movie')->with('success', 'Film berhasil diperbarui!');
    }


    public function index()
    {
        // Ambil semua data film dengan relasi kategori dan urutkan terbaru
        $movies = Movie::with('category')->latest()->paginate(10);

        return view('dataMovie', compact('movies'));
    }
}
