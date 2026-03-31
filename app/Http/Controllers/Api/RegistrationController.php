<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $format = $request->query('format');
        $search = $request->query('search');

        // Fitur Search seperti pada Category
        $registration = Registration::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        // 1. FORMAT HTML (Tabel)
        if (!$format || $format === 'html') {
            return response()->view('api.registrations', compact('registration'))
                             ->header('Content-Type', 'text/html');
        }

        // 2. FORMAT XML
        if ($format === 'xml') {
            $xml = new \SimpleXMLElement('<root/>');
            foreach ($registration as $reg) {
                $item = $xml->addChild('registration');
                $item->addChild('id', $reg->id);
                $item->addChild('name', $reg->name);
                $item->addChild('team_name', $reg->team_name);
                $item->addChild('user_id', $reg->user_id);
                $item->addChild('event_id', $reg->event_id);
            }
            return response($xml->asXML(), 200)->header('Content-Type', 'application/xml');
        }

        // 3. FORMAT JS (JSONP)
        if ($format === 'js') {
            $callback = $request->query('callback', 'tampilkanEvent');
            $jsonData = json_encode(['success' => true, 'data' => $registration]);
            return response($callback . "(" . $jsonData . ");", 200)
                    ->header('Content-Type', 'application/javascript');
        }

        // 4. DEFAULT JSON
        return response()->json([
            'success' => true,
            'data' => $registration
        ]);
    }


    public function show($id)
    {
        return response()->json(Registration::with(['user', 'event'])->findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'team_name' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        $registration = Registration::create($data);
        return response()->json($registration, 201);
    }

    // App\Http\Controllers\Api\RegistrationController.php

public function update(Request $request, $id)
{
    // Cari data secara manual agar Anda bisa memberikan pesan error kustom
    $registration = \App\Models\Registration::find($id);

    if (!$registration) {
        return response()->json([
            'success' => false,
            'message' => "Data pendaftaran dengan ID $id tidak ditemukan di database."
        ], 404);
    }

    // Validasi data yang masuk
    $validated = $request->validate([
        'name' => 'sometimes|string|max:255',
        'team_name' => 'nullable|string|max:255',
    ]);

    $registration->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Update berhasil',
        'data' => $registration
    ]);
}

    public function destroy($id)
    {
      // 1. Cari data pendaftaran berdasarkan ID
    $registration = \App\Models\Registration::find($id);

    // 2. Jika data tidak ditemukan
    if (!$registration) {
        return response()->json([
            'success' => false,
            'message' => 'Data pendaftaran tidak ditemukan'
        ], 404);
    }

    // 3. Hapus data
    $registration->delete();

    // 4. Berikan respon sukses
    return response()->json([
        'success' => true,
        'message' => 'Data pendaftaran berhasil dihapus'
    ], 200);
    }
}
