<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'E - Parking | Petugas')</title>
    @vite(['resources/js/app.js'])
</head>
<body >
<body class="bg-light">
    @include('petugas.partials.navbar')
    <div class="d-flex" style="height: calc(100vh - 56px);">
        @include('petugas.partials.sidebar')

        <main class="p-4 flex-fill overflow-auto">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.querySelector(".sidebar");

            if (!sidebar) return;

            const savedScroll = localStorage.getItem("sidebar-scroll");
            if (savedScroll) {
                sidebar.scrollTop = savedScroll;
            }

            sidebar.addEventListener("scroll", function() {
                localStorage.setItem("sidebar-scroll", sidebar.scrollTop);
            });
        });
    </script>
</body>
</html>