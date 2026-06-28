@extends('layouts.app')

@section('title', 'Login - Premium URL Shortener')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="login-container">
        <div class="text-center mb-8">
            <h1 class="title">URL Shortener</h1>
            <p style="color: var(--text-muted);">Sign in to your account</p>
        </div>

        <div class="glass-panel">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="admin@example.com" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn">Sign In</button>
            </form>
        </div>
    </div>
</div>
@endsection
