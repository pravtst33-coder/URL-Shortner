<h1>You're Invited!</h1>
<p>You have been invited to join <strong>{{ $invitation->company->name }}</strong>.</p>
<p>Click the link below to accept your invitation and set up your account:</p>
<a href="{{ route('invite', ['token' => $invitation->token]) }}">{{ route('invite', ['token' => $invitation->token]) }}</a>
