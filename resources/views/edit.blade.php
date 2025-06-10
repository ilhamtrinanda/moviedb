@extends('layouts.template')

@section('content')
    <div class="container mt-4">
        <h2>Edit Film</h2>

        <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" value="{{ $movie->title }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $movie->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Tahun</label>
                <input type="number" name="year" value="{{ $movie->year }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="actors" class="form-label">Aktor</label>
                <input type="text" name="actors" value="{{ $movie->actors }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="synopsis" class="form-label">Sinopsis</label>
                <textarea name="synopsis" class="form-control" rows="4" required>{{ $movie->synopsis }}</textarea>
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover</label>
                <input type="file" name="cover_image" class="form-control">
                @if ($movie->cover_image)
                    <img src="{{ asset('storage/' . $movie->cover_image) }}" width="120" class="mt-2">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/data-movie" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
