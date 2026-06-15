<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Novel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NovelController extends Controller
{
    public function index()
    {
        $novels = Novel::with('category')->latest()->get();
        return view('admin.novels.index', compact('novels'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.novels.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Novel::create($validated);

        return redirect()->route('admin.novels.index')->with('success', 'Novel created successfully.');
    }

    public function edit(Novel $novel)
    {
        $categories = Category::all();
        return view('admin.novels.edit', compact('novel', 'categories'));
    }

    public function update(Request $request, Novel $novel)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($novel->cover_image) {
                Storage::disk('public')->delete($novel->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $novel->update($validated);

        return redirect()->route('admin.novels.index')->with('success', 'Novel updated successfully.');
    }

    public function destroy(Novel $novel)
    {
        if ($novel->cover_image) {
            Storage::disk('public')->delete($novel->cover_image);
        }
        $novel->delete();
        return redirect()->route('admin.novels.index')->with('success', 'Novel deleted successfully.');
    }
}
