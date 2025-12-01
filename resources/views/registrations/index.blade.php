@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Data Registrations</h3>
        <a href="{{ route('registrations.create') }}" class="btn btn-primary">Tambah Registrasi</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Team</th>
                <th>User</th>
                <th>Event</th>
                <th width="160px">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($registrations as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->name }}</td>
                <td>{{ $r->team_name }}</td>
                <td>{{ $r->user->name }}</td>
                <td>{{ $r->event->title }}</td>
                <td>
                    <a href="{{ route('registrations.edit', $r->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('registrations.destroy', $r->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Yakin hapus data?')" 
                                class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $registrations->links() }}

</div>
@endsection
