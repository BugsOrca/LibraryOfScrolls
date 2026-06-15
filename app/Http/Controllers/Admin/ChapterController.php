<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Novel;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index(Request $request)
    {
        $novel_id = $request->query('novel_id');
        $novel = null;
        
        if ($novel_id) {
            $novel = Novel::findOrFail($novel_id);
            $chapters = Chapter::where('novel_id', $novel_id)->orderBy('chapter_number')->get();
        } else {
            $chapters = Chapter::with('novel')->orderBy('novel_id')->orderBy('chapter_number')->get();
        }

        return view('admin.chapters.index', compact('chapters', 'novel'));
    }

    public function create(Request $request)
    {
        $novel_id = $request->query('novel_id');
        $novel = $novel_id ? Novel::findOrFail($novel_id) : null;
        $novels = Novel::all();
        
        return view('admin.chapters.create', compact('novel', 'novels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'novel_id' => 'required|exists:novels,id',
            'title' => 'required|string|max:255',
            'chapter_number' => 'required|integer|min:1',
            'content' => 'required|string',
        ]);

        Chapter::create($validated);

        return redirect()->route('admin.chapters.index', ['novel_id' => $validated['novel_id']])
                         ->with('success', 'Chapter added successfully.');
    }

    public function edit(Chapter $chapter)
    {
        $novels = Novel::all();
        return view('admin.chapters.edit', compact('chapter', 'novels'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $validated = $request->validate([
            'novel_id' => 'required|exists:novels,id',
            'title' => 'required|string|max:255',
            'chapter_number' => 'required|integer|min:1',
            'content' => 'required|string',
        ]);

        $chapter->update($validated);

        return redirect()->route('admin.chapters.index', ['novel_id' => $chapter->novel_id])
                         ->with('success', 'Chapter updated successfully.');
    }

    public function destroy(Chapter $chapter)
    {
        $novel_id = $chapter->novel_id;
        $chapter->delete();
        return redirect()->route('admin.chapters.index', ['novel_id' => $novel_id])
                         ->with('success', 'Chapter deleted successfully.');
    }
}
