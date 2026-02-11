<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'E - Parking | Admin')</title>
    @vite(['resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
    @include('admin.partials.navbar')
    <div class="app-wrapper d-flex">
        @include('admin.partials.sidebar')
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <main class="p-4 flex-fill content-wrapper">
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

        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById("sidebarToggle");
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("sidebarOverlay");

            if (!toggleBtn || !sidebar || !overlay) return;

            toggleBtn.addEventListener("click", function() {
                sidebar.classList.toggle("show");
                overlay.classList.toggle("show");
            });

            overlay.addEventListener("click", function() {
                sidebar.classList.remove("show");
                overlay.classList.remove("show");
            });
        });
    </script>
</body>

</html>
