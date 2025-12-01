@extends('layouts.app')
@section('title','Edit User')
@section('content')
<h2>Edit User</h2>

        
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add New User</a>


@if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
@endif

<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name',$user->name) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password (leave empty to keep)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Role</label>
        <select name="role" class="form-select" required>
            <option value="user" {{ old('role',$user->role)=='user'?'selected':'' }}>Student</option>
            <option value="admin" {{ old('role',$user->role)=='admin'?'selected':'' }}>Admin</option>
        </select>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
