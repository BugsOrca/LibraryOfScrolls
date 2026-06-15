@extends('layouts.app')

@section('title', 'Browse Novels - Library of Scrolls')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3">
        <h2 class="fw-bold mb-0">Browse Library</h2>
        
        <div class="d-flex gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-funnel"></i> Genre: {{ request('category') ? ucfirst(request('category')) : 'All' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-dark shadow">
                    <li><a class="dropdown-item {{ !request('category') ? 'active' : '' }}" href="{{ route('browse', ['sort' => request('sort')]) }}">All Genres</a></li>
                    <li><hr class="dropdown-divider"></li>
                    @foreach($categories as $category)
                        <li><a class="dropdown-item {{ request('category') == $category->slug ? 'active' : '' }}" href="{{ route('browse', ['category' => $category->slug, 'sort' => request('sort')]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-sort-down"></i> Sort: {{ request('sort') == 'latest' ? 'Latest Updates' : 'A-Z' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-dark shadow">
                    <li><a class="dropdown-item {{ request('sort') != 'latest' ? 'active' : '' }}" href="{{ route('browse', ['category' => request('category')]) }}">Title (A-Z)</a></li>
                    <li><a class="dropdown-item {{ request('sort') == 'latest' ? 'active' : '' }}" href="{{ route('browse', ['sort' => 'latest', 'category' => request('category')]) }}">Latest Updates</a></li>
                </ul>
            </div>
        </div>
    </div>

    @if($novels->count() > 0)
        <div class="row g-4">
            @foreach($novels as $novel)
            <div class="col-6 col-md-3 col-lg-2">
                <a href="{{ route('novels.show', $novel) }}" class="text-decoration-none">
                    <div class="glass-card h-100 p-2 novel-card border-0 bg-transparent shadow-none position-relative">
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
            {{ $novels->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="text-center py-5">
            <div class="text-muted mb-3 fs-1"><i class="bi bi-journal-x"></i></div>
            <h4 class="text-muted">No novels found in this category.</h4>
            <a href="{{ route('browse') }}" class="btn btn-outline-light mt-3">Clear Filters</a>
        </div>
    @endif
</div>
@endsection
