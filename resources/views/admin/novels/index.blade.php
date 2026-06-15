@extends('layouts.admin')

@section('title', 'Manage Novels')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Novels</h4>
        <a href="{{ route('admin.novels.create') }}" class="btn btn-primary" style="background-color:#6366f1; border:none;">Add New Novel</a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($novels as $number=>$novel)
                <tr>
                    <td>{{++$number }}</td>
                    <td>
                        @if($novel->cover_image)
                            <img src="{{ asset('storage/' . $novel->cover_image) }}" alt="Cover" width="50" height="70" style="object-fit: cover; border-radius: 4px;">
                        @else
                            <div class="bg-secondary text-center" style="width:50px; height:70px; border-radius:4px; line-height:70px;">No IMG</div>
                        @endif
                    </td>
                    <td class="fw-bold">{{ $novel->title }}</td>
                    <td>{{ $novel->author }}</td>
                    <td><span class="badge bg-secondary">{{ $novel->category->name }}</span></td>
                    <td>
                        <a href="{{ route('admin.chapters.index', ['novel_id' => $novel->id]) }}" class="btn btn-sm btn-info text-white">Chapters</a>
                        <a href="{{ route('admin.novels.edit', $novel) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.novels.destroy', $novel) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">No novels found. Add one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
