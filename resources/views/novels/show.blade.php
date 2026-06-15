@extends('layouts.app')

@section('title', $novel->title . ' - Library of Scrolls')

@section('content')
<div class="container py-5">
    <div class="glass-card p-4 p-md-5 mb-5">
        <div class="row">
            <div class="col-md-3 mb-4 mb-md-0 text-center text-md-start">
                @if($novel->cover_image)
                    <img src="{{ asset('storage/' . $novel->cover_image) }}" alt="Cover" class="img-fluid rounded shadow" style="max-height: 400px; width: 100%; object-fit: cover;">
                @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center rounded shadow" style="height: 350px; width: 100%;">No Cover</div>
                @endif
            </div>
            <div class="col-md-9">
                <h1 class="fw-bold mb-2">{{ $novel->title }}</h1>
                <p class="text-muted mb-4 fs-5">By <span class="text-light fw-semibold">{{ $novel->author }}</span></p>
                
                <div class="d-flex gap-2 mb-4">
                    <span class="badge" style="background-color: var(--secondary-color); font-size: 0.9rem; padding: 0.5em 1em;">{{ $novel->category->name }}</span>
                    <span class="badge bg-dark border border-secondary text-light d-flex align-items-center" style="font-size: 0.9rem; padding: 0.5em 1em;">
                        Chapters: {{ $novel->chapters->count() }}
                    </span>
                </div>

                <div class="d-flex gap-3 mb-4">
                    @if($novel->chapters->count() > 0)
                        <a href="{{ route('chapters.show', ['novel' => $novel->id, 'chapter' => $novel->chapters->first()->id]) }}" class="btn btn-primary-gradient btn-lg px-4 fw-bold">Read First Chapter</a>
                    @else
                        <button class="btn btn-secondary btn-lg" disabled>No Chapters Yet</button>
                    @endif

                    @auth
                        <form action="{{ route('novels.bookmark', $novel) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-lg {{ $isBookmarked ? 'btn-danger' : 'btn-outline-light' }}">
                                {{ $isBookmarked ? 'Remove Bookmark' : 'Add to Bookmarks' }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Login to Bookmark</a>
                    @endauth
                </div>

                <h5 class="fw-bold border-bottom border-secondary pb-2 mb-3">Synopsis</h5>
                <p class="text-light lh-lg" style="white-space: pre-line;">{{ $novel->synopsis }}</p>
            </div>
        </div>
    </div>

    <!-- Chapters List -->
    <h3 class="fw-bold mb-4"><span style="color:var(--primary-color);">|</span> Table of Contents</h3>
    <div class="row g-3">
        @forelse($novel->chapters as $chapter)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('chapters.show', ['novel' => $novel->id, 'chapter' => $chapter->id]) }}" class="text-decoration-none text-light">
                <div class="glass-card p-3 d-flex justify-content-between align-items-center chapter-card" style="transition: all 0.2s;">
                    <span class="text-muted me-2">Ch. {{ $chapter->chapter_number }}</span>
                    <span class="text-truncate fw-semibold flex-grow-1">{{ $chapter->title }}</span>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12">
            <p class="text-muted">No chapters available for this novel.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    .chapter-card:hover {
        background: rgba(99,102,241,0.2) !important;
        transform: translateX(5px);
    }
</style>
@endsection
