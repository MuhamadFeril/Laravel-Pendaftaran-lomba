# 🎯 Sistem Pendaftaran Lomba

Aplikasi **Laravel** untuk pendaftaran lomba dengan dua role utama:

- **Admin** → Mengelola Kategori, Subkategori, Event, dan melihat pendaftaran  
- **User** → Melihat Event & mendaftar lomba  

Semua user berada pada satu tabel `users` dengan kolom `role`.

---

## 📛 Tech Stack

![Laravel](https://img.shields.io/badge/Laravel-10-red)
![PHP](https://img.shields.io/badge/PHP-8.0+-blue)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-blueviolet)

---

## 📥 Persiapan

Pastikan sudah meng-install:

- PHP 8+
- MySQL  
- Composer → **https://getcomposer.org/download/**


Clone project (opsional):

```bash
git clone https://github.com/username/laravel-pendaftaran-lomba.git
cd laravel-pendaftaran-lomba
```

---

## 🚀 Instalasi Project

### 1️⃣ Buat Project Laravel

```bash
composer create-project laravel/laravel pendaftaran-lomba
cd pendaftaran-lomba
```

### 2️⃣ Konfigurasi Database

Edit file `config/database.php`:

```php
'mysql' => [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'port' => '3306',
    'database' => 'pendaftaran_lomba',
    'username' => 'root',
    'password' => '',
],
```

### 3️⃣ Migrasi Database

```bash
php artisan migrate
```

### 4️⃣ Jalankan Server

```bash
php artisan serve
```

Akses aplikasi:  
👉 http://127.0.0.1:8000

---

## 🗂 Struktur Proyek

```
pendaftaran-lomba/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       ├── CategoryController.php
│   │       ├── SubcategoryController.php
│   │       ├── EventController.php
│   │       └── RegistrationController.php
│   └── Models/
│       ├── User.php
│       ├── Category.php
│       ├── Subcategory.php
│       ├── Event.php
│       └── Registration.php
├── routes/web.php
├── resources/views/
│   ├── layouts/
│   │   ├── admin.blade.php
│   │   └── user.blade.php
│   ├── categories/
│   ├── subcategories/
│   ├── events/
│   └── registration/
└── public/assets/
```

---

## 🛠 Pembuatan Controller

```bash
php artisan make:controller AuthController
php artisan make:controller CategoryController --resource
php artisan make:controller SubcategoryController --resource
php artisan make:controller EventController --resource
php artisan make:controller RegistrationController --resource
```

---

## 🔗 Routing (routes/web.php)

```php
Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('events', EventController::class);

Route::resource('registration', RegistrationController::class)
    ->only(['index','create','store','show']);

Route::get('/admin/registrations',[RegistrationController::class,'adminIndex']);
Route::get('/events',[EventController::class,'userIndex']);
```

---

## 🎨 Tampilan Frontend

### 🧩 Admin Layout (`resources/views/layouts/admin.blade.php`)

```html
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
```

---

### 🧩 User Layout (`resources/views/layouts/user.blade.php`)

```html
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
```

---

## 📝 Form Pendaftaran User (`resources/views/registration/create.blade.php`)

```php
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
```

---

## 📌 Fitur Utama

✔ Sistem Role (Admin & User)  
✔ CRUD: Category, Subcategory, Event, Registration  
✔ Tampilan Admin & User terpisah  
✔ Database langsung dari config  
✔ Mudah dijalankan di localhost  

---

## 📎 Lisensi

Project ini bebas digunakan untuk pembelajaran & pengembangan.

