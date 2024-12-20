@extends('auth.layouts')
@section('content')
<form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3 row">
        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $gallery->title) }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
        <div class="col-md-6">
            <textarea class="form-control" id="description" rows="5" name="description">{{ old('description', $gallery->description) }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="picture" class="col-md-4 col-form-label text-md-end text-start">Picture</label>
        <div class="col-md-6">
            <input type="file" class="form-control" id="picture" name="picture">
            @if ($gallery->picture)
                <img src="{{ asset('storage/' . $gallery->picture) }}" alt="Gallery Picture" width="100" class="mt-2">
            @endif
            @error('picture')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>
    </div>
</form>
@endsection
