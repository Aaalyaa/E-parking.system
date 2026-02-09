@extends(auth()->user()->layout())

@section('content')
<div class="container">
    <h3 class="fw-bold">User Profile</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="card-text">Username: {{ $user->username }}</p>
            <p class="card-text">Peran: {{ $user->role->peran }}</p>
            <a href="{{ route('profile.editPassword') }}" class="btn btn-primary">Ubah Password</a>
        </div>
    </div>
</div>
@endsection