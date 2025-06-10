@extends('layouts.template')
@section('content')
    <h1>Data Movie</h1>

    {{-- Tampilkan pesan sukses jika ada --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="/create_movie" class="btn btn-success mb-4">Input Movie</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Year</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $index => $movie)
                <tr>
                    <th scope="row">{{ $index + $movies->firstItem() }}</th>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->category->category_name }}</td>
                    <td>{{ $movie->year }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="" class="btn btn-success btn-sm">Show</a>
                            <a href="/editmovie/{{ $movie->id }}" class="btn btn-warning btn-sm">Edit</a>
                            @can('delete')
                                <form action="movie-delete/{{ $movie->id }}" method="post">
                                    @csrf
                                    <button onclick="return confirm('Are you sure to delete this movie?')"
                                        class="btn btn-danger btn-sm">Delete</button>
                                @endcan
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
