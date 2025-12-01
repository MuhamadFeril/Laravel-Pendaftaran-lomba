@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container mt-4">
    <h2>Edit Category</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                value="{{ old('name', $category->name) }}"
                required
            >
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
