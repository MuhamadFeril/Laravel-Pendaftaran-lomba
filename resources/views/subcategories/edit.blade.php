@extends('layouts.app')

@section('title', 'Edit Subcategory')

@section('content')
<div class="container mt-4">
    <h2>Edit Subcategory</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Subcategory Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $subcategory->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('subcategories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
