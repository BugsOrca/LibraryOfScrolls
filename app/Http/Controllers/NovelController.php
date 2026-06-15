<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Novel;
use App\Models\ReadingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NovelController extends Controller
{
    public function show(Novel $novel)
    {
        $novel->load('category', 'chapters');
        $isBookmarked = false;
        
        if (Auth::check()) {
            $isBookmarked = Auth::user()->bookmarks()->where('novel_id', $novel->id)->exists();
        }
        
        return view('novels.show', compact('novel', 'isBookmarked'));
    }
}
