<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Novel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function history()
    {
        $histories = Auth::user()->readingHistories()->with(['novel', 'chapter'])->orderByDesc('last_read_at')->get();
        return view('member.history', compact('histories'));
    }

    public function bookmarks()
    {
        $bookmarks = Auth::user()->bookmarks()->with('novel.category')->get();
        return view('member.bookmarks', compact('bookmarks'));
    }

    public function toggleBookmark(Request $request, Novel $novel)
    {
        $bookmark = Auth::user()->bookmarks()->where('novel_id', $novel->id)->first();
        
        if ($bookmark) {
            $bookmark->delete();
            return back()->with('success', 'Removed from bookmarks.');
        } else {
            Auth::user()->bookmarks()->create(['novel_id' => $novel->id]);
            return back()->with('success', 'Added to bookmarks.');
        }
    }
}
