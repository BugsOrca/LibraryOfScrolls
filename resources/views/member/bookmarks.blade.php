@extends('layouts.app')

@section('title', 'My Bookmarks - Library of Scrolls')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 border-bottom border-secondary pb-3">
        <h2 class="fw-bold mb-0">My Bookmarks</h2>
        <div>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn me-2 fw-bold shadow-sm" style="background-color: #ec4899; color: #fff;">Admin Panel</a>
            @endif
            <a href="{{ route('member.history') }}" class="btn btn-outline-light me-2">Reading History</a>
            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(20, 184, 166, 0.2); border-color: #14b8a6; color: #fff;">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse($bookmarks as $bookmark)
        <div class="col-6 col-md-4 col-lg-2">
            <div class="glass-card h-100 p-2 border-0 bg-transparent shadow-none position-relative">
                <a href="{{ route('novels.show', $bookmark->novel) }}" class="text-decoration-none">
                    <div class="novel-cover-wrapper mb-2" style="height: 220px;">
                        @if($bookmark->novel->cover_image)
                            <img src="{{ asset('storage/' . $bookmark->novel->cover_image) }}" alt="{{ $bookmark->novel->title }}" class="novel-cover">
                        @else
                            <div class="bg-secondary h-100 w-100 d-flex align-items-center justify-content-center text-white" style="border-radius: 8px;">No Cover</div>
                        @endif
                    </div>
                    <h6 class="text-light fw-bold text-truncate mb-1">{{ $bookmark->novel->title }}</h6>
                    <small class="text-muted d-block text-truncate mb-2">{{ $bookmark->novel->category->name }}</small>
                </a>
                
                <form action="{{ route('novels.bookmark', $bookmark->novel) }}" method="POST" class="mt-2 position-absolute top-0 end-0 m-2">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger rounded-circle shadow" title="Remove Bookmark">
                        &times;
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted mb-3 fs-1"><i class="bi bi-bookmark"></i></div>
            <h4 class="text-muted">No bookmarks yet.</h4>
            <p class="text-muted">Save your favorite novels here to access them quickly.</p>
            <a href="{{ route('home') }}" class="btn btn-primary-gradient mt-3">Browse Novels</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
