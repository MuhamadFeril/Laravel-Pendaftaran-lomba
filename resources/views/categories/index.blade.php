@extends('layouts.app')
@section('title','Categories')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Categories</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Add Category</a>
</div>

<table class="table table-bordered">
<thead class="table-dark"><tr><th>#</th><th>Name</th><th>Action</th></tr></thead>
<tbody>
@foreach($categories as $c)
<tr>
  <td>{{ $loop->iteration }}</td>
  <td>{{ $c->name }}</td>
  <td>
    <a href="{{ route('categories.edit',$c) }}" class="btn btn-sm btn-warning">Edit</a>
    <form action="{{ route('categories.destroy',$c) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
      @csrf @method('DELETE')
      <button class="btn btn-sm btn-danger">Del</button>
    </form>
  </td>
</tr>
@endforeach
</tbody>
</table>
@endsection
