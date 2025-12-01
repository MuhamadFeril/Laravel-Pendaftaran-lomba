@extends('layouts.auth')

@section('title', 'Login - Pendaftaran')

@section('content')
<div class="login-container">
    <div class="text-center mb-5">
        <h2>Pendaftaran</h2>
        <p class="text-muted">Masuk ke Akun Anda</p>
    </div>

    <div class="login-card">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('auth.login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" 
                       placeholder="Masukan email" 
                       required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Masukkan password" 
                       required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Masuk</button>
        </form>

        <hr>

        <div class="text-center">
            <p class="mb-0">Belum punya akun? <a href="{{ route('auth.register') }}">Daftar di sini</a></p>
        </div>
    </div>

    <div class="text-center mt-4">
        <p class="text-muted small">© 2025 Sistem Pendaftaran Ofefan</p>
    </div>
</div>

<style>
    body {
        background-color: #f5f5f5;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .login-container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
    }

    .login-card {
        background: white;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 10px 12px;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
        font-weight: 500;
        padding: 10px;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    .alert {
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    a {
        color: #0d6efd;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    @media (max-width: 576px) {
        .login-container {
            padding: 15px;
        }

        .login-card {
            padding: 20px;
        }
    }
</style>
@endsection

