@extends('layouts.app')

@section('title', 'Dashboard - Premium URL Shortener')

@section('content')
<div class="min-h-screen" style="padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 class="title">Dashboard</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn" style="width: auto; background: var(--error);">Logout</button>
        </form>
    </div>

    <div class="glass-panel mb-8">
        <h2>Your Info</h2>
        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Role:</strong> {{ auth()->user()->role->name ?? 'Unknown' }}</p>
        @if(auth()->user()->company)
            <p><strong>Company:</strong> {{ auth()->user()->company->name }}</p>
        @endif
    </div>

    @if(session('success'))
        <div style="background: var(--primary); padding: 1rem; border-radius: 8px; margin-bottom: 2rem; color: white;">
            {{ session('success') }}
            @if(session('invite_link'))
                <br><strong>Invite Link:</strong> <a href="{{ session('invite_link') }}" style="color: white; text-decoration: underline;">{{ session('invite_link') }}</a>
            @endif
        </div>
    @endif
    @if($errors->any())
        <div style="background: var(--error); padding: 1rem; border-radius: 8px; margin-bottom: 2rem; color: white;">
            {{ $errors->first() }}
        </div>
    @endif

    @if(auth()->user()->role_id !== 1)
        <div class="glass-panel mb-8">
            <h2 style="margin-bottom: 1rem;">Generate Short URL</h2>
            <form action="{{ route('urls.store') }}" method="POST" style="display: flex; gap: 1rem;">
                @csrf
                <input type="url" name="original_url" class="form-control" placeholder="e.g. https://example.com/very-long-url" required>
                <button type="submit" class="btn" style="width: auto;">Generate</button>
            </form>
        </div>
    @endif

    @if(auth()->user()->role_id === 1 || auth()->user()->role_id === 2)
        <div class="glass-panel mb-8">
            <h2 style="margin-bottom: 1rem;">Invite New {{ auth()->user()->role_id === 1 ? 'Client Admin' : 'Team Member' }}</h2>
            <form action="{{ route('invitations.store') }}" method="POST" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                @csrf
                @if(auth()->user()->role_id === 1)
                    <input type="text" name="company_name" class="form-control" placeholder="New Company Name" style="flex: 1; min-width: 200px;" required>
                @endif
                <input type="email" name="email" class="form-control" placeholder="Invite Email" style="flex: 1; min-width: 200px;" required>
                
                @if(auth()->user()->role_id === 2)
                    <select name="role_id" class="form-control" style="flex: 1; min-width: 200px;" required>
                        <option value="2">Admin</option>
                        <option value="3">Member</option>
                    </select>
                @endif
                
                <button type="submit" class="btn" style="width: auto;">Send Invitation</button>
            </form>
        </div>
    @endif

    <div class="glass-panel mb-8">
        <h2 style="margin-bottom: 1rem;">Short URLs ({{ $urls->total() }})</h2>
        <ul style="list-style: none; color: var(--text-muted);">
            @foreach($urls as $url)
                <li style="margin-bottom: 0.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid var(--surface-border); display: flex; justify-content: space-between;">
                    <div>
                        <a href="{{ url($url->short_code) }}" target="_blank" style="color: var(--primary); font-weight: bold; text-decoration: none;">{{ url($url->short_code) }}</a> 
                        -> {{ Str::limit($url->original_url, 50) }}
                    </div>
                    <span style="font-size: 0.8rem;">(Company: {{ $url->company->name ?? 'N/A' }}, User: {{ $url->user->name ?? 'N/A' }})</span>
                </li>
            @endforeach
            @if($urls->isEmpty())
                <li>No URLs found.</li>
            @endif
        </ul>
        <div style="margin-top: 1rem;">
            {{ $urls->links() }}
        </div>
    </div>
</div>
@endsection
