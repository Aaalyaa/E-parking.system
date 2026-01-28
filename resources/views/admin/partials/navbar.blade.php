<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand fw-bold">
        E-Parking | Admin
    </span>

    <div class="d-flex align-items-center gap-3 text-white">
        @auth
        <a href="{{ route('profile.index') }}" class="text-white text-decoration-none">
            {{ auth()->user()->username }}
        </a>
        @endauth
        |
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
        </form>
    </div>
</nav>