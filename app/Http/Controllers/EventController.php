<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // ====================== INDEX ======================
    public function index()
    {
        $events = Event::with('subcategory')->get();
        return view('events.index', compact('events'));
        return response()->json([
    'success' => true,
    'data' => $events
], 200);

    }

    

    // ====================== CREATE ======================
 public function create()
{
    // Anda harus mengambil data subcategories dari database terlebih dahulu
    $subcategories = \App\Models\Subcategory::all(); 

    // Sekarang variabel $subcategories tersedia untuk dikirim ke view
    return view('events.create', compact('subcategories'));
}
    // ====================== STORE ======================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'nullable|date',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        $validated['created'] = now();
        $validated['updated'] = now();
        Event::create($validated);

        return redirect()->route('events.index')
                         ->with('success', 'Event berhasil ditambahkan!');
    }

    // ====================== EDIT ======================
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $subcategories = Subcategory::all();

        return view('events.edit', compact('event', 'subcategories'));
    }

    // ====================== UPDATE ======================
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'nullable|date',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        $event = Event::findOrFail($id);
        $validated['updated'] = now();
        $event->update($validated);

        return redirect()->route('events.index')
                         ->with('success', 'Event berhasil diperbarui!');
    }

    // ====================== DELETE ======================
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return redirect()->route('events.index')
                         ->with('success', 'Event berhasil dihapus!');
    }
}
