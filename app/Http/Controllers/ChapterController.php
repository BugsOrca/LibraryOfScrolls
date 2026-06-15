<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Novel;
use App\Models\ReadingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    public function show(Novel $novel, Chapter $chapter)
    {
        if ($chapter->novel_id !== $novel->id) {
            abort(404);
        }

        // Record reading history
        if (Auth::check()) {
            ReadingHistory::updateOrCreate(
                ['user_id' => Auth::id(), 'novel_id' => $novel->id],
                ['chapter_id' => $chapter->id, 'last_read_at' => now()]
            );
        }

        $nextChapter = Chapter::where('novel_id', $novel->id)
            ->where('chapter_number', '>', $chapter->chapter_number)
            ->orderBy('chapter_number', 'asc')
            ->first();

        $prevChapter = Chapter::where('novel_id', $novel->id)
            ->where('chapter_number', '<', $chapter->chapter_number)
            ->orderBy('chapter_number', 'desc')
            ->first();

        return view('chapters.show', compact('novel', 'chapter', 'nextChapter', 'prevChapter'));
    }
}
