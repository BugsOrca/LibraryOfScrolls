@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="glass-card p-4">
            <h4 class="fw-bold mb-4">Categories</h4>
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Novels Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td class="fw-bold">{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->novels_count }}</td>
                            <td>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-4">
            <h4 class="fw-bold mb-4">Add Category</h4>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-light">Name</label>
                    <input type="text" name="name" class="form-control bg-dark border-secondary text-white" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
