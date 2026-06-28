@extends('layouts.app')

@section('title', 'Register - Premium URL Shortener')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="login-container">
        <div class="text-center mb-8">
            <h1 class="title">Create Account</h1>
            <p style="color: var(--text-muted);">Register your company</p>
        </div>

        <div class="glass-panel">
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" id="company_name" name="company_name" class="form-control" value="{{ old('company_name') }}" required autofocus>
                    @error('company_name')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    @error('password')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn">Register</button>
                <div class="text-center mt-4" style="margin-top: 1rem;">
                    <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-size: 0.875rem;">Already have an account? Sign in</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
