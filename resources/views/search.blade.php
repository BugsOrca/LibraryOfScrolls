@extends('layouts.app')

@section('title', 'Search Results - Library of Scrolls')

@section('content')
<div class="container py-5">
    <div class="mb-5 text-center">
        <h2 class="fw-bold">Search Results</h2>
        <p class="text-muted">Showing results for "{{ $query }}"</p>
    </div>

    @if($novels->count() > 0)
        <div class="row g-4">
            @foreach($novels as $novel)
            <div class="col-6 col-md-3 col-lg-2">
                <a href="{{ route('novels.show', $novel) }}" class="text-decoration-none">
                    <div class="glass-card h-100 p-2 novel-card border-0 bg-transparent shadow-none">
                        <div class="novel-cover-wrapper mb-2" style="height: 220px;">
                            @if($novel->cover_image)
                                <img src="{{ asset('storage/' . $novel->cover_image) }}" alt="{{ $novel->title }}" class="novel-cover">
                            @else
                                <div class="bg-secondary h-100 w-100 d-flex align-items-center justify-content-center text-white" style="border-radius: 8px;">No Cover</div>
                            @endif
                        </div>
                        <h6 class="text-light fw-bold text-truncate mb-1">{{ $novel->title }}</h6>
                        <small class="text-muted d-block text-truncate">{{ $novel->category->name }}</small>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="mt-5 d-flex justify-content-center">
            {{ $novels->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="text-center py-5">
            <h4 class="text-muted">No novels found matching your query.</h4>
            <a href="{{ route('home') }}" class="btn btn-outline-light mt-3">Back to Home</a>
        </div>
    @endif
</div>
@endsection
