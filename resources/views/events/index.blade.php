@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Data Events</h2>

    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Tambah Event</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Subcategory</th>
                <th width="150px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $e)
            <tr>
                <td>{{ $e->id }}</td>
                <td>{{ $e->title }}</td>
                <td>{{ $e->date }}</td>
                <td>{{ $e->subcategory->name ?? '-' }}</td>

                <td>
                    <a href="{{ route('events.edit', $e->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('events.destroy', $e->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus event?')" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $events->links() }}

</div>
@endsection
