@extends('layouts.app')

@section('title', 'Chapter ' . $chapter->chapter_number . ' - ' . $novel->title)

@section('content')
<div class="container-fluid" style="background-color: #121212; min-height: 100vh;">
    <div class="row justify-content-center py-4">
        <div class="col-lg-8 col-xl-7">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-color);">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('novels.show', $novel) }}" class="text-decoration-none" style="color: var(--primary-color);">{{ $novel->title }}</a></li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">Chapter {{ $chapter->chapter_number }}</li>
                </ol>
            </nav>

            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">{{ $chapter->title }}</h2>
                <h5 class="text-muted">Chapter {{ $chapter->chapter_number }}</h5>
            </div>

            <!-- Top Navigation -->
            <div class="d-flex justify-content-between mb-5">
                @if($prevChapter)
                    <a href="{{ route('chapters.show', ['novel' => $novel->id, 'chapter' => $prevChapter->id]) }}" class="btn btn-outline-secondary px-4">&laquo; Previous</a>
                @else
                    <button class="btn btn-outline-secondary px-4 disabled">&laquo; Previous</button>
                @endif
                
                <a href="{{ route('novels.show', $novel) }}" class="btn btn-outline-secondary"><i class="bi bi-list"></i> Index</a>

                @if($nextChapter)
                    <a href="{{ route('chapters.show', ['novel' => $novel->id, 'chapter' => $nextChapter->id]) }}" class="btn btn-primary-gradient px-4">Next &raquo;</a>
                @else
                    <button class="btn btn-outline-secondary px-4 disabled">Next &raquo;</button>
                @endif
            </div>

            <!-- Content -->
            <div class="reading-content fs-5 lh-lg mb-5" style="color: #e2e8f0; font-family: Georgia, serif; white-space: pre-line;">
                {{ $chapter->content }}
            </div>

            <!-- Bottom Navigation -->
            <div class="d-flex justify-content-between border-top border-secondary pt-4 pb-5">
                @if($prevChapter)
                    <a href="{{ route('chapters.show', ['novel' => $novel->id, 'chapter' => $prevChapter->id]) }}" class="btn btn-outline-secondary px-4">&laquo; Previous</a>
                @else
                    <button class="btn btn-outline-secondary px-4 disabled">&laquo; Previous</button>
                @endif
                
                <a href="{{ route('novels.show', $novel) }}" class="btn btn-outline-secondary"><i class="bi bi-list"></i> Index</a>

                @if($nextChapter)
                    <a href="{{ route('chapters.show', ['novel' => $novel->id, 'chapter' => $nextChapter->id]) }}" class="btn btn-primary-gradient px-4">Next &raquo;</a>
                @else
                    <button class="btn btn-outline-secondary px-4 disabled">Next &raquo;</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
