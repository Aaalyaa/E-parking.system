<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'E - Parking | Admin')</title>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-light">
    @include('admin.partials.navbar')
    <div class="d-flex" style="height: calc(100vh - 56px);">
        @include('admin.partials.sidebar')

        <main class="p-4 flex-fill overflow-auto">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>