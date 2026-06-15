@extends('layouts.app')

@section('title', 'Reading History - Library of Scrolls')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 border-bottom border-secondary pb-3">
        <h2 class="fw-bold mb-0">Reading History</h2>
        <div>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn me-2 fw-bold shadow-sm" style="background-color: #ec4899; color: #fff;">Admin Panel</a>
            @endif
            <a href="{{ route('member.bookmarks') }}" class="btn btn-outline-light me-2">View Bookmarks</a>
            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <div class="row g-4">
        @forelse($histories as $history)
        <div class="col-md-6 col-lg-4">
            <div class="glass-card p-3 d-flex align-items-center h-100">
                <a href="{{ route('novels.show', $history->novel) }}" class="me-3" style="width: 70px; height: 100px; flex-shrink: 0;">
                    @if($history->novel->cover_image)
                        <img src="{{ asset('storage/' . $history->novel->cover_image) }}" alt="Cover" class="w-100 h-100 rounded object-fit-cover">
                    @else
                        <div class="bg-secondary w-100 h-100 rounded d-flex align-items-center justify-content-center" style="font-size: 10px;">No Cover</div>
                    @endif
                </a>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="fw-bold text-truncate mb-1">
                        <a href="{{ route('novels.show', $history->novel) }}" class="text-light text-decoration-none">{{ $history->novel->title }}</a>
                    </h5>
                    <p class="text-muted small mb-2">Ch. {{ $history->chapter->chapter_number }} - {{ Str::limit($history->chapter->title, 20) }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <small class="text-muted" style="font-size: 0.8rem;">{{ $history->last_read_at->diffForHumans() }}</small>
                        <a href="{{ route('chapters.show', ['novel' => $history->novel_id, 'chapter' => $history->chapter_id]) }}" class="btn btn-sm btn-primary-gradient">Continue</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted mb-3 fs-1"><i class="bi bi-clock-history"></i></div>
            <h4 class="text-muted">No reading history yet.</h4>
            <p class="text-muted">Start reading novels and they will appear here!</p>
            <a href="{{ route('home') }}" class="btn btn-primary-gradient mt-3">Browse Novels</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
