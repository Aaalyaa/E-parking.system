<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'E - Parking | Petugas')</title>
    @vite(['resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

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
