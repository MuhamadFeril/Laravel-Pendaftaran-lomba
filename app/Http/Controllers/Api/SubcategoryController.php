<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        $format = $request->query('format');
        $search = $request->query('search');
$subcategories = Subcategory::all();
        // Fitur Search seperti pada Category
        $subcategory = Subcategory::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        // 1. FORMAT HTML (Tabel)
       if (!$format || $format === 'html') {
        // Pastikan nama variabel di compact sesuai
        return response()->view('api.subcategories', compact('subcategories'))
                         ->header('Content-Type', 'text/html');
    }

        // 2. FORMAT XML
        if ($format === 'xml') {
            $xml = new \SimpleXMLElement('<root/>');
            foreach ($subcategory as $subcat) {
                $item = $xml->addChild('subcategory');
                $item->addChild('id', $subcat->id);
                $item->addChild('name', $subcat->name);
                $item->addChild('category_id', $subcat->category_id);
            }
            return response($xml->asXML(), 200)->header('Content-Type', 'application/xml');
        }

        // 3. FORMAT JS (JSONP)
        if ($format === 'js') {
            $callback = $request->query('callback', 'tampilkanEvent');
            $jsonData = json_encode(['success' => true, 'data' => $subcategory]);
            return response($callback . "(" . $jsonData . ");", 200)
                    ->header('Content-Type', 'application/javascript');
        }

        // 4. DEFAULT JSON
        return response()->json([
            'success' => true,
            'data' => $subcategory
        ]);
    }

    public function show($id)
    {
        return response()->json(Subcategory::with('category','events')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'steps' => 'nullable|array',
            'steps.*' => 'string',
        ]);

        $subcategory = Subcategory::create($data);
        return response()->json($subcategory, 201);
    }

    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $subcategory->update($data);
        return response()->json($subcategory);
    }

    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        return response()->json(null, 204);
    }
}
