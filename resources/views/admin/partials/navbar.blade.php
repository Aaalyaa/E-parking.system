<nav class="navbar navbar-dark bg-dark px-3">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-outline-light d-lg-none" id="sidebarToggle" aria-label="Toggle sidebar">
            <i class="bi bi-list fs-4"></i>
        </button>

        <span class="navbar-brand fw-bold mb-0">
            E-Parking | Admin
        </span>
    </div>

    <div class="d-flex align-items-center gap-3 text-white">
        @auth
            <a href="{{ route('profile.index') }}" class="text-white text-decoration-none">
                {{ auth()->user()->username }}
            </a>
        @endauth
        |
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-light"
                onclick="localStorage.removeItem('sidebar-scroll')">Logout</button>
        </form>
    </div>
</nav>
