@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="glass-card p-4 text-center">
            <h3 class="fw-bold" style="color: #6366f1;">{{ \App\Models\User::count() }}</h3>
            <p class="text-muted mb-0">Total Users</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card p-4 text-center">
            <h3 class="fw-bold" style="color: #8b5cf6;">{{ \App\Models\Novel::count() }}</h3>
            <p class="text-muted mb-0">Total Novels</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card p-4 text-center">
            <h3 class="fw-bold" style="color: #ec4899;">{{ \App\Models\Chapter::count() }}</h3>
            <p class="text-muted mb-0">Total Chapters</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card p-4 text-center">
            <h3 class="fw-bold" style="color: #14b8a6;">{{ \App\Models\Category::count() }}</h3>
            <p class="text-muted mb-0">Categories</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="glass-card p-4">
            <h5 class="fw-bold mb-4">Quick Actions</h5>
            <div class="d-flex gap-3">
                <a href="{{ route('admin.novels.create') }}" class="btn btn-primary" style="background-color:#6366f1; border:none;">Add New Novel</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Manage Categories</a>
            </div>
        </div>
    </div>
</div>
@endsection
