<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'E - Parking | Petugas')</title>
</head>
<body>
    @include('petugas.partials.navbar')
    <div style="display: flex;">
        @include('petugas.partials.sidebar')

        <main style="padding: 20px; width: 100%;">
            @yield('content')
        </main>
    </div>
</body>
</html>