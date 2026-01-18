<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
</head>
<body>
    @include('admin.partials.navbar')
    <div style="display: flex;">
        @include('admin.partials.sidebar')

        <main style="padding: 20px; width: 100%;">
            @yield('content')
        </main>
    </div>
</body>