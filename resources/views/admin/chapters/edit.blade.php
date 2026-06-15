@extends('layouts.admin')

@section('title', 'Edit Chapter')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Edit Chapter</h4>
        <a href="{{ route('admin.chapters.index', ['novel_id' => $chapter->novel_id]) }}" class="btn btn-secondary">Back</a>
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

    <form action="{{ route('admin.chapters.update', $chapter) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label text-light">Select Novel</label>
            <select name="novel_id" class="form-select bg-dark border-secondary text-white" required>
                @foreach($novels as $nvl)
                    <option value="{{ $nvl->id }}" {{ (old('novel_id', $chapter->novel_id) == $nvl->id) ? 'selected' : '' }}>{{ $nvl->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label text-light">Chapter Number</label>
                    <input type="number" name="chapter_number" class="form-control bg-dark border-secondary text-white" value="{{ old('chapter_number', $chapter->chapter_number) }}" required min="1">
                </div>
            </div>
            <div class="col-md-9">
                <div class="mb-3">
                    <label class="form-label text-light">Chapter Title</label>
                    <input type="text" name="title" class="form-control bg-dark border-secondary text-white" value="{{ old('title', $chapter->title) }}" required>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label text-light">Content</label>
            <textarea name="content" rows="15" class="form-control bg-dark border-secondary text-white" required style="font-family: monospace;">{{ old('content', $chapter->content) }}</textarea>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-warning btn-lg fw-bold">Update Chapter</button>
        </div>
    </form>
</div>
@endsection
