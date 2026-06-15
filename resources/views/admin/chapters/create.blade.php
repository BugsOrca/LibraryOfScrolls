@extends('layouts.admin')

@section('title', 'Add Chapter')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Add New Chapter</h4>
        <a href="{{ $novel ? route('admin.chapters.index', ['novel_id' => $novel->id]) : route('admin.chapters.index') }}" class="btn btn-secondary">Back</a>
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

    <form action="{{ route('admin.chapters.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label class="form-label text-light">Select Novel</label>
            <select name="novel_id" class="form-select bg-dark border-secondary text-white" required>
                @if(!$novel) <option value="">Select Novel</option> @endif
                @foreach($novels as $nvl)
                    <option value="{{ $nvl->id }}" {{ (old('novel_id', optional($novel)->id) == $nvl->id) ? 'selected' : '' }}>{{ $nvl->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label text-light">Chapter Number</label>
                    <input type="number" name="chapter_number" class="form-control bg-dark border-secondary text-white" value="{{ old('chapter_number') }}" required min="1">
                </div>
            </div>
            <div class="col-md-9">
                <div class="mb-3">
                    <label class="form-label text-light">Chapter Title</label>
                    <input type="text" name="title" class="form-control bg-dark border-secondary text-white" value="{{ old('title') }}" required>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label text-light">Content</label>
            <textarea name="content" rows="15" class="form-control bg-dark border-secondary text-white" required style="font-family: monospace;">{{ old('content') }}</textarea>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg" style="background-color:#6366f1; border:none;">Publish Chapter</button>
        </div>
    </form>
</div>
@endsection
