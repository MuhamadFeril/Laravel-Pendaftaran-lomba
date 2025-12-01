<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Pendaftaran')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">Pendaftaran</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto d-flex gap-3 align-items-center">
                    <a href="{{ route('dashboard.index') }}" class="nav-link text-light">Dashboard</a>
                    <a href="{{ route('registrations.index') }}" class="nav-link text-light">Registrations</a>

                    @if(Auth::user() && Auth::user()->role === 'admin')
                        <a href="{{ route('users.index') }}" class="nav-link text-light">Users</a>
                        <a href="{{ route('events.index') }}" class="nav-link text-light">Events</a>
                        <a href="{{ route('categories.index') }}" class="nav-link text-light">Categories</a>
                        <a href="{{ route('subcategories.index') }}" class="nav-link text-light">Subcategories</a>
                    @endif
                    
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('auth.logout') }}" method="POST" class="dropdown-item p-0">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-decoration-none w-100 text-start">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <style>
        /* Ensure page content is visible below the fixed navbar */
        body {
            padding-top: 70px;
        }
        @media (max-width: 576px) {
            body { padding-top: 90px; }
        }
        .navbar .dropdown-menu { z-index: 1100; }
    </style>
    @endauth

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

