<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of all registrations.
     */
    public function index()
    {
        $registrations = Registration::with(['user', 'event'])->paginate(10);
        return view('registrations.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new registration.
     */
    public function create()
    {
        $events = Event::all();
        return view('registrations.create', compact('events'));
    }

    /**
     * Store a newly created registration in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'team_name' => 'nullable|string|max:255',
            'event_id'  => 'required|exists:events,id',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['created'] = now();
        $validated['updated'] = now();
        Registration::create($validated);

        return redirect()->route('registrations.index')
            ->with('success', 'Registrasi lomba berhasil!');
    }

    /**
     * Display the specified registration.
     */
    public function show($id)
    {
        $registration = Registration::with(['user', 'event'])->findOrFail($id);
        return view('registrations.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified registration.
     */
    public function edit($id)
    {
        $registration = Registration::findOrFail($id);
        $events = Event::all();

        return view('registrations.edit', compact('registration', 'events'));
    }

    /**
     * Update the specified registration in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'team_name' => 'nullable|string|max:255',
            'user_id'   => 'required|exists:users,id',
            'event_id'  => 'required|exists:events,id',
        ]);

        $registration = Registration::findOrFail($id);
        $validated['updated'] = now();
        $registration->update($validated);

        return redirect()->route('registrations.index')
            ->with('success', 'Registrasi berhasil diperbarui!');
    }

    /**
     * Remove the specified registration from storage.
     */
    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return redirect()->route('registrations.index')
            ->with('success', 'Registrasi berhasil dihapus!');
    }
}
