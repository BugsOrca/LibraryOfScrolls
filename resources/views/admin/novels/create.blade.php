@extends('layouts.admin')

@section('title', 'Add New Novel')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Add New Novel</h4>
        <a href="{{ route('admin.novels.index') }}" class="btn btn-secondary">Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.novels.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label text-light">Title</label>
                    <input type="text" name="title" class="form-control bg-dark border-secondary text-white" value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Author</label>
                    <input type="text" name="author" class="form-control bg-dark border-secondary text-white" value="{{ old('author') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Category</label>
                    <select name="category_id" class="form-select bg-dark border-secondary text-white" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Synopsis</label>
                    <textarea name="synopsis" rows="5" class="form-control bg-dark border-secondary text-white" required>{{ old('synopsis') }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label text-light">Cover Image</label>
                    <input type="file" name="cover_image" class="form-control bg-dark border-secondary text-white" accept="image/*">
                    <div class="form-text text-muted">Recommended size: 400x600px.</div>
                </div>
                
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg" style="background-color:#6366f1; border:none;">Save Novel</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
