<nav style="padding: 10px; background: #222; color: white;">
    <strong>E-Parking | Admin</strong>

    <span style="float: right;">
        @auth
        <a href="{{ route('profile.index') }}">
            {{ auth()->user()->username }}
        </a>
        @endauth
        |
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </span>
</nav>