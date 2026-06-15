<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredNovels = Novel::with('category')->latest()->take(6)->get();
        $popularNovels = Novel::with('category')->withCount('bookmarks')->orderByDesc('bookmarks_count')->take(2)->get();
        
        return view('home', compact('featuredNovels', 'popularNovels'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $novels = Novel::with('category')
            ->where('title', 'like', "%{$query}%")
            ->orWhere('author', 'like', "%{$query}%")
            ->orWhereHas('category', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->paginate(12);
            
        return view('search', compact('novels', 'query'));
    }

    public function browse(Request $request)
    {
        $query = Novel::with('category');

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->sort === 'latest') {
            $query->latest('updated_at');
        } else {
            $query->orderBy('title');
        }

        $novels = $query->paginate(18);
        $categories = \App\Models\Category::all();

        return view('browse', compact('novels', 'categories'));
    }
}
