# 🎯 Sistem Pendaftaran Lomba



Aplikasi ini digunakan untuk pendaftaran lomba dengan dua role pengguna:

Admin: mengelola Kategori, Subkategori, Event, dan melihat daftar pendaftar.

User: melihat Event dan mendaftar lomba.


Semua user tersimpan di satu tabel users dengan kolom role untuk membedakan admin dan user.

Download Composer (jika belum ada): https://getcomposer.org/download/

Clone project (opsional jika ingin langsung dari GitHub):

git clone https://github.com/username/laravel-pendaftaran-lomba.git
cd laravel-pendaftaran-lomba


---

🚀 Instalasi Project

1️⃣ Buat project baru

composer create-project laravel/laravel pendaftaran-lomba
cd pendaftaran-lomba

2️⃣ Atur database di config/database.php

'mysql' => [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'port' => '3306',
    'database' => 'pendaftaran_lomba',
    'username' => 'root',
    'password' => '',
],

3️⃣ Migrasi database

php artisan migrate

4️⃣ Jalankan server

php artisan serve


---

🗂 Struktur Proyek

pendaftaran-lomba/
├── app/
│   ├── Http/
│   │     └── Controllers/
│   │           ├── AuthController.php
│   │           ├── CategoryController.php
│   │           ├── SubcategoryController.php
│   │           ├── EventController.php
│   │           └── RegistrationController.php
│   └── Models/
│         ├── User.php
│         ├── Category.php
│         ├── Subcategory.php
│         ├── Event.php
│         └── Registration.php
├── routes/web.php
├── resources/views/
│     ├── layouts/
│     │     ├── admin.blade.php
│     │     └── user.blade.php
│     ├── categories/
│     ├── subcategories/
│     ├── events/
│     └── registration/
└── public/assets/


---

🛠 Pembuatan Controller

php artisan make:controller AuthController
php artisan make:controller CategoryController --resource
php artisan make:controller SubcategoryController --resource
php artisan make:controller EventController --resource
php artisan make:controller RegistrationController --resource


---

🛠 Routing (routes/web.php)

Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::resource('categories',CategoryController::class);
Route::resource('subcategories',SubcategoryController::class);
Route::resource('events',EventController::class);
Route::resource('registration',RegistrationController::class)->only(['index','create','store','show']);
Route::get('/admin/registrations',[RegistrationController::class,'adminIndex']);
Route::get('/events',[EventController::class,'userIndex']);


---

🎨 FRONTEND

Admin Layout

resources/views/layouts/admin.blade.php

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand text-white">Admin Panel</span>
    </div>
</nav>
<div class="container">@yield('content')</div>
</body>
</html>

User Layout

resources/views/layouts/user.blade.php

<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Lomba</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-light bg-primary mb-3">
    <div class="container">
        <span class="navbar-brand text-white">Pendaftaran Lomba</span>
    </div>
</nav>
<div class="container">@yield('content')</div>
</body>
</html>

Form Pendaftaran User

resources/views/registration/create.blade.php

@extends('layouts.user')
@section('content')
<h3>Pendaftaran Lomba</h3>
<form action="{{ route('registration.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Peserta</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Pilih Event</label>
        <select name="event_id" class="form-control">
            @foreach($events as $e)
            <option value="{{ $e->id }}">{{ $e->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success">Daftar</button>
</form>
@endsection

📌 Cara Menjalankan Laravel

1. Pastikan PHP, MySQL, Composer sudah terinstall


2. Jalankan migrasi:



php artisan migrate

3. Jalankan server Laravel:



php artisan serve

4. Akses aplikasi melalui browser: http://127.0.0.1:8000




---

📝 Penjelasan

Tabel Users digunakan untuk semua user dan admin, dengan kolom role

CRUD tersedia untuk Category, Subcategory, Event, Registration

Frontend terpisah: admin untuk pengelolaan, user untuk pendaftaran

Routing sederhana tanpa middleware (langsung akses ke controller)

Database diatur di config/database.php tanpa .env

Bisa langsung di-upload ke GitHub dan dijalankan di browser lokal

---


 

