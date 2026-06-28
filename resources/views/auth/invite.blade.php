@extends('layouts.app')

@section('title', 'Accept Invitation - Premium URL Shortener')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="login-container">
        <div class="text-center mb-8">
            <h1 class="title">Accept Invitation</h1>
            <p style="color: var(--text-muted);">Set your name and password to join {{ $invitation->company->name }}</p>
        </div>

        <div class="glass-panel">
            <form action="{{ route('invite', ['token' => $invitation->token]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" value="{{ $invitation->email }}" disabled>
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" id="name" name="name" class="form-control" required autofocus>
                    @error('name')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-6">
                    <label for="password" class="form-label">Choose Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    @error('password')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn">Complete Registration</button>
            </form>
        </div>
    </div>
</div>
@endsection
