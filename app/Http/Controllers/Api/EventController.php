<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
   public function index(Request $request)
    {
        $format = $request->query('format');
        $search = $request->query('search');

        // Fitur Search seperti pada Category
        $events = Event::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->get();
        

        // 1. FORMAT HTML (Tabel)
        if (!$format || $format === 'html') {
            return response()->view('api.events', compact('events'))
                             ->header('Content-Type', 'text/html');
        }

        // 2. FORMAT XML
        if ($format === 'xml') {
            $xml = new \SimpleXMLElement('<root/>');
            foreach ($events as $event) {
                $item = $xml->addChild('event');
                $item->addChild('id', $event->id);
                $item->addChild('title', $event->title);
                $item->addChild('location', $event->location);
            }
            return response($xml->asXML(), 200)->header('Content-Type', 'application/xml');
        }

        // 3. FORMAT JS (JSONP)
        if ($format === 'js') {
            $callback = $request->query('callback', 'tampilkanEvent');
            $jsonData = json_encode(['success' => true, 'data' => $events]);
            return response($callback . "(" . $jsonData . ");", 200)
                    ->header('Content-Type', 'application/javascript');
        }

        // 4. DEFAULT JSON
        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }


    public function show($id)
    {
        return response()->json(Event::with('subcategory')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        $event = Event::create($data);
        return response()->json($event, 201);
    }
 public function update(Request $request, $id)
{
    $event = Event::findOrFail($id); // Mencari Event, bukan Registration

    $data = $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'date' => 'sometimes|required|date',
        'subcategory_id' => 'sometimes|required|exists:subcategories,id',
    ]);

    $event->update($data);

    return response()->json([
        'success' => true,
        'message' => 'Data Event berhasil diperbarui',
        'data' => $event
    ], 200);
}
   public function create()
{
    // Anda harus mengambil data subcategories dari database terlebih dahulu
    $subcategories = \App\Models\Subcategory::all(); 

    // Sekarang variabel $subcategories tersedia untuk dikirim ke view
    return view('events.create', compact('subcategories'));
}
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return response()->json(null, 204);
    }
    
}
