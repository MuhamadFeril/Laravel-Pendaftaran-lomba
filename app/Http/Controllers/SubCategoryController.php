<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return view('subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Subcategory::create($request->only('name', 'category_id'));

        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
    }

    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($request->only('name', 'category_id'));

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $subcategory = Subcategory::withCount('events')->findOrFail($id);

        if ($subcategory->events_count > 0) {
            return redirect()->route('subcategories.index')
                ->with('error', "Subcategory cannot be deleted because it has {$subcategory->events_count} related event(s). Delete or reassign those events first.");
        }

        $subcategory->delete();

        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }
}
