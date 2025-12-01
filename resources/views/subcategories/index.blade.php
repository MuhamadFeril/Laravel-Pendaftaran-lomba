@extends('layouts.app')

@section('title', 'Subcategories')

@section('content')
<div class="container mt-4">
    <h2>Subcategories</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('subcategories.create') }}" class="btn btn-success mb-3">+ Create Subcategory</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategories as $subcategory)
            <tr>
                <td>{{ $subcategory->id }}</td>
                <td>{{ $subcategory->name }}</td>
                <td>{{ $subcategory->category->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this subcategory?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
