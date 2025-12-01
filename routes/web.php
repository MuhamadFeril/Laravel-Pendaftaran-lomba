<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth Routes (Public)
Route::get('/', [AuthController::class, 'showLoginForm'])->name('auth.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register.form');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Protected Routes (Require Authentication)
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // Registrations available to all authenticated users (users and admins)
    Route::resource('registrations', RegistrationController::class);

    // Admin-only resources
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('subcategories', SubcategoryController::class);
        Route::resource('events', EventController::class);
    });
});


