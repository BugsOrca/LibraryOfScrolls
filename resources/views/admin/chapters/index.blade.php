@extends('layouts.admin')

@section('title', 'Manage Chapters')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Chapters {{ $novel ? 'for ' . $novel->title : '' }}</h4>
        <div>
            @if($novel)
                <a href="{{ route('admin.novels.index') }}" class="btn btn-secondary me-2">Back to Novels</a>
                <a href="{{ route('admin.chapters.create', ['novel_id' => $novel->id]) }}" class="btn btn-primary" style="background-color:#6366f1; border:none;">Add Chapter</a>
            @else
                <a href="{{ route('admin.chapters.create') }}" class="btn btn-primary" style="background-color:#6366f1; border:none;">Add Chapter</a>
            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    @if(!$novel) <th>Novel</th> @endif
                    <th>Ch #</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($chapters as $chapter)
                <tr>
                    @if(!$novel) <td>{{ $chapter->novel->title }}</td> @endif
                    <td>{{ $chapter->chapter_number }}</td>
                    <td class="fw-bold">{{ $chapter->title }}</td>
                    <td>
                        <a href="{{ route('admin.chapters.edit', $chapter) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.chapters.destroy', $chapter) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">No chapters found. Add one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
