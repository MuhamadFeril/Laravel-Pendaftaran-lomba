<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
public function index(Request $request)
{
    // Mengambil semua data kategori
    $categories = Category::all();
    
    // Mengambil parameter ?format= dari URL
    $format = $request->query('format');

    // 1. FORMAT XML (?format=xml)
    if ($format === 'xml') {
        $xml = new \SimpleXMLElement('<root/>');
        foreach ($categories as $category) {
            $item = $xml->addChild('category');
            $item->addChild('id', $category->id);
            $item->addChild('name', $category->name);
        }
        return response($xml->asXML(), 200)
                ->header('Content-Type', 'text/xml');
    }

    // 2. FORMAT HTML (?format=html)
    if ($format === 'html' || !$request->wantsJson()) {
    return response()->view('api.categories', compact('categories'))
                     ->header('Content-Type', 'text/html');
}
// 3. FORMAT JAVASCRIPT / JSONP (?format=js)
if ($format === 'js') {
    $callback = $request->query('callback', 'tampilkanData');
    // Keamanan: Pastikan callback hanya berisi karakter yang diizinkan
    $callback = preg_replace('/[^a-zA-Z0-9_]/', '', $callback); 

    $jsonData = json_encode([
        'success' => true,
        'data'    => $categories
    ]);
return response($callback . "(" . $jsonData . ");", 200)
        ->header('Content-Type', 'application/javascript; charset=utf-8');
    // GUNAKAN response() atau response()->make() daripada response()->text()
    return response($callback . "(" . $jsonData . ");", 200)
            ->header('Content-Type', 'application/javascript; charset=utf-8');
}

    // 4. DEFAULT: FORMAT JSON (Tanpa parameter atau format lain)
    return response()->json([
        'success' => true,
        'data'    => $categories
    ]);
}
    public function show($id)
    {
        return response()->json(Category::with('subcategories')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create($data);
        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
        ]);

        $category->update($data);
        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(null, 204);
    }
}
