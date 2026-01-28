@extends(auth()->user()->layout())

@section('content')
<div class="container">
    <h1>User Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="card-text">Username: {{ $user->username }}</p>
            <p class="card-text">Role: {{ $user->role->peran }}</p>
            <a href="{{ route('profile.editPassword') }}" class="btn btn-primary">Change Password</a>
        </div>
    </div>
</div>
@endsection