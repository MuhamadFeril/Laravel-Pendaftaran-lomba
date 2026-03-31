<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // READ
    public function index()
    {
        // 1. Ambil semua data user dari database
    $users = \App\Models\User::all(); 

    // 2. Kirim variabel $users ke view
    return view('users.index', compact('users'));
    }

    // CREATE - form
    public function create()
    {
        return view('users.create');
    }

    // CREATE - save
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    // UPDATE - form
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // UPDATE - save
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required'
        ]);

        $data = $request->only('name', 'email', 'role');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }
    public function destroy()
{
    abort(403, 'Aksi hapus tidak diizinkan.');
}

}
