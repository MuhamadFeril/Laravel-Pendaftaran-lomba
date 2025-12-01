<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }
        return view('auth.login');
    }

    /**
     * Handle login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Show the register form.
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }
        return view('auth.register');
    }

    /**
     * Handle registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_type' => 'required|in:user,admin',
            'admin_email' => 'nullable|email',
            'admin_password' => 'nullable|min:6',
        ]);

        // Determine role based on role_type
        $role = 'user';

        if ($validated['role_type'] === 'admin') {
            // Check that admin fields are provided
            if (empty($validated['admin_email']) || empty($validated['admin_password'])) {
                return back()
                    ->withErrors(['admin_password' => 'Email dan password admin harus diisi.'])
                    ->withInput();
            }

            // Validate admin credentials
            $adminEmail = config('app.admin_email', 'admin@pendaftaran.com');
            $adminPassword = config('app.admin_password', 'admin123');

            if ($validated['admin_email'] !== $adminEmail || $validated['admin_password'] !== $adminPassword) {
                return back()
                    ->withErrors(['admin_password' => 'Email atau password admin tidak sesuai.'])
                    ->withInput();
            }

            $role = 'admin';
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $role,
        ]);

        Auth::login($user);
        return redirect()->route('dashboard.index')->with('success', 'Registrasi berhasil! Selamat datang!');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
