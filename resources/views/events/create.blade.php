@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
<div class="container mt-4">
    <h2>Create Event</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Event Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Event Date</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subcategory_id" class="form-label">Subcategory</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" required>
                <option value="">-- Select Subcategory --</option>
                @foreach($subcategories as $sub)
                    <option value="{{ $sub->id }}" {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>
                        {{ $sub->name }} ({{ $sub->category->name ?? '-' }})
                    </option>
                @endforeach
            </select>
            @error('subcategory_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
