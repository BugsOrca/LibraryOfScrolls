@extends('layouts.app')

@section('title', 'Login - Library of Scrolls')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="glass-card p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Welcome Back</h2>
                        <p class="text-muted">Enter your details to proceed.</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger" style="background: rgba(220,53,69,0.2); border: 1px solid #dc3545; color: #ffb3b3;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label text-light">Email Address</label>
                            <input type="email" class="form-control bg-dark border-secondary text-white" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label text-light">Password</label>
                            <input type="password" class="form-control bg-dark border-secondary text-white" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input bg-dark border-secondary" id="remember" name="remember">
                            <label class="form-check-label text-light" for="remember">Remember me</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-gradient py-2 fw-bold">Sign In</button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" style="color: var(--primary-color); text-decoration: none;">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
