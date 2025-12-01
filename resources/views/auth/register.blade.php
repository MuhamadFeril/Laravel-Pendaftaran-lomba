@extends('layouts.auth')

@section('title', 'Register - Pendaftaran')

@section('content')
<div class="register-container">
    <div class="text-center mb-5">
        <h2>Pendaftaran</h2>
        <p class="text-muted">Buat Akun Baru</p>
    </div>

    <div class="register-card">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('auth.register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" id="name" name="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" 
                       placeholder="Nama Anda" 
                       required autofocus>
            </div>

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
                       placeholder="Minimal 6 karakter" 
                       required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                       class="form-control" 
                       placeholder="Konfirmasi password" 
                       required>
            </div>

            <hr>

            <div class="mb-3">
                <label class="form-label">Daftar Sebagai</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="role_user" name="role_type" value="user" checked>
                        <label class="form-check-label" for="role_user">User Biasa</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="role_admin" name="role_type" value="admin">
                        <label class="form-check-label" for="role_admin">Admin</label>
                    </div>
                </div>
            </div>

            <div id="admin-section" style="display:none;">
                <div class="alert alert-info small mb-3">
                    Untuk mendaftar sebagai Admin, masukkan email dan password admin yang sesuai.
                </div>
                <div class="mb-3">
                    <label for="admin_email" class="form-label">Email Admin</label>
                    <input type="email" id="admin_email" name="admin_email" 
                           class="form-control @error('admin_email') is-invalid @enderror" 
                           value="{{ old('admin_email') }}" 
                           placeholder="Email admin">
                </div>
                <div class="mb-3">
                    <label for="admin_password" class="form-label">Password Admin</label>
                    <input type="password" id="admin_password" name="admin_password" 
                           class="form-control @error('admin_password') is-invalid @enderror" 
                           placeholder="Password admin">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Daftar</button>
        </form>

        <hr>

        <div class="text-center">
            <p class="mb-0">Sudah punya akun? <a href="{{ route('auth.login.form') }}">Masuk di sini</a></p>
        </div>
    </div>

    <div class="text-center mt-4">
        <p class="text-muted small">© 2025 Sistem Pendaftaran</p>
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

    .register-container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
    }

    .register-card {
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
        .register-container {
            padding: 15px;
        }

        .register-card {
            padding: 20px;
        }
    }
</style>

<script>
    document.querySelectorAll('input[name="role_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const adminSection = document.getElementById('admin-section');
            if (this.value === 'admin') {
                adminSection.style.display = 'block';
            } else {
                adminSection.style.display = 'none';
            }
        });
    });
</script>
@endsection
