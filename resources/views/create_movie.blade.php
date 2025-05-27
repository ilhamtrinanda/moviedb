@extends('layouts.template')

@section('content')
    <h1>Input New Movie</h1>
    <form action="/movie" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- judul --}}
        <div class="mb-3 row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" id="title">
            </div>
        </div>
        {{-- sinopsis --}}
        <div class="mb-3 row">
            <label for="synopsis" class="col-sm-2 col-form-label">Synopsis</label>
            <div class="col-sm-10">
                <textarea name="synopsis" class="form-control" id="synopsis" rows="5">{{ old('synopsis') }}</textarea>
            </div>
        </div>
        {{-- kategori --}}
        <div class="mb-3 row">
            <label for="category_id" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->category_name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
        {{-- tahun --}}
        <div class="mb-3 row">
            <label for="year" class="col-sm-2 col-form-label">Year</label>
            <div class="col-sm-10">
                <input name="year" type="text" class="form-control" id="year" value="{{ old('year') }}">
            </div>
        </div>
        {{-- aktor --}}
        <div class="mb-3 row">
            <label for="actors" class="col-sm-2 col-form-label">Actors</label>
            <div class="col-sm-10">
                <input name="actors" type="text" class="form-control" id="actors" value="{{ old('actors') }}">
            </div>
        </div>
        {{-- gambar --}}
        <div class="mb-3 row">
            <label for="cover_image" class="col-sm-2 col-form-label">Cover Image :</label>
            <div class="col-sm-10">
                <input type="file" name="cover_image" id="cover_image"
                    class="form-control
                    @error('cover_image') is-invalid @enderror"
                    value="{{ old('cover_image') }}">
                @error('cover_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        {{-- button --}}
        <div class="mb-3 row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
