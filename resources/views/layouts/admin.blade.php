<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Admin CSS -->
    <style>
        body { background-color: #0f172a; color: #f8fafc; font-family: 'Inter', sans-serif; }
        .sidebar { min-height: 100vh; background: #1e293b; border-right: 1px solid #334155; }
        .sidebar .nav-link { color: #cbd5e1; transition: all 0.3s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(99,102,241,0.1); border-radius: 8px; }
        .topbar { background: rgba(30,41,59,0.8); backdrop-filter: blur(10px); border-bottom: 1px solid #334155; }
        .glass-card { background: rgba(30, 41, 59, 0.7); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="width: 250px;">
            <h4 class="text-white text-center mb-4 mt-2 fw-bold"><span style="color:#6366f1;">Admin</span>Panel</h4>
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">Manage Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.novels.*', 'admin.chapters.*') ? 'active' : '' }}" href="{{ route('admin.novels.index') }}">Manage Novels</a>
                </li>
                <li class="nav-item mt-5">
                    <a class="nav-link" href="{{ url('/') }}">Back to Site</a>
                </li>
                <li class="nav-item mt-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link text-danger w-100 text-start" style="background: none; border: none; padding: 0.5rem 1rem;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <nav class="navbar navbar-expand-lg topbar px-4 py-3 sticky-top">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1 fw-bold">Library of Scrolls Dashboard</span>
                    <div class="d-flex align-items-center">
                        <span class="text-muted me-3">Welcome, {{ Auth::user()->name }}</span>
                    </div>
                </div>
            </nav>

            <div class="p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
