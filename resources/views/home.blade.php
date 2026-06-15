@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="py-5 text-center position-relative" style="background: linear-gradient(rgba(15,23,42,0.5), rgba(15,23,42,1)), url('https://images.unsplash.com/photo-1519681393784-d120267933ba') center/cover; min-height: 400px; display: flex; align-items: center;">
    <div class="container position-relative z-1">
        <h1 class="display-4 fw-bold text-white mb-3">Dive Into Infinite Worlds</h1>
        <p class="lead text-light mb-4">Read thousands of web novels, light novels, and original fiction for free.</p>
        <a href="#featured" class="btn btn-primary-gradient btn-lg px-5 rounded-pill fw-bold">Start Reading</a>
    </div>
</div>

<div class="container py-5" id="featured">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold"><span style="color:var(--primary-color);">|</span> Featured Novels</h3>
    </div>
    <div class="row g-4">
        @foreach($featuredNovels as $novel)
        <div class="col-6 col-md-4 col-lg-2">
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
</div>

<div class="container pb-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold"><span style="color:var(--primary-color);">|</span> Popular Right Now</h3>
            </div>
            <div class="row g-4">
                @foreach($popularNovels as $novel)
                <div class="col-md-6">
                    <div class="glass-card p-3 d-flex h-100 align-items-center">
                        <a href="{{ route('novels.show', $novel) }}" class="d-block me-3" style="width: 80px; height: 110px; flex-shrink: 0;">
                            @if($novel->cover_image)
                                <img src="{{ asset('storage/' . $novel->cover_image) }}" alt="cover" class="w-100 h-100 rounded object-fit-cover">
                            @else
                                <div class="bg-secondary w-100 h-100 rounded"></div>
                            @endif
                        </a>
                        <div>
                            <a href="{{ route('novels.show', $novel) }}" class="text-decoration-none text-light">
                                <h5 class="fw-bold mb-1 line-clamp-1">{{ $novel->title }}</h5>
                            </a>
                            <p class="text-muted small mb-2"><i class="bi bi-person"></i> {{ $novel->author }}</p>
                            <span class="badge" style="background-color: var(--secondary-color);">{{ $novel->category->name }}</span>
                            <span class="badge bg-dark border border-secondary text-light"><i class="bi bi-bookmark"></i> {{ $novel->bookmarks_count }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4">
            <div class="glass-card p-4 h-100">
                <h4 class="fw-bold mb-4">Reading Journey</h4>
                @guest
                    <p class="text-muted text-center py-4">Login to track your reading progress and bookmarks.</p>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="btn btn-outline-light">Login Now</a>
                    </div>
                @else
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn w-100 mb-3 fw-bold shadow" style="background: linear-gradient(135deg, #ec4899, #f43f5e); color: #fff;">
                            <i class="bi bi-speedometer2"></i> Admin Panel
                        </a>
                    @endif
                    <a href="{{ route('member.history') }}" class="btn btn-primary-gradient w-100 mb-3">View Reading History</a>
                    <a href="{{ route('member.bookmarks') }}" class="btn w-100 mb-4" style="background: rgba(255,255,255,0.05); color: #fff;">My Bookmarks</a>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection
