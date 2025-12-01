@extends('layouts.app')

@section('title', 'Daftar Lomba')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Daftar Lomba</h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="alert alert-info small mb-3">
                        <strong>Pendaftar:</strong> {{ Auth::user()->name }} ({{ Auth::user()->email }})
                    </div>

                    <form action="{{ route('registrations.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Peserta</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" placeholder="Nama lengkap peserta" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Team (Opsional)</label>
                            <input type="text" name="team_name" class="form-control @error('team_name') is-invalid @enderror"
                                   value="{{ old('team_name') }}" placeholder="Nama team (jika ada)">
                            @error('team_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilih Lomba</label>
                            <select name="event_id" class="form-control @error('event_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Lomba --</option>
                                @foreach($events as $e)
                                    <option value="{{ $e->id }}" {{ old('event_id') == $e->id ? 'selected' : '' }}>
                                        {{ $e->title }} ({{ $e->date ? \Carbon\Carbon::parse($e->date)->format('d M Y') : 'TBD' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('event_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Daftar Lomba</button>
                            <a href="{{ route('registrations.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
