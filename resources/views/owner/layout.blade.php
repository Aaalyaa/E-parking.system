<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'E - Parking | Owner')</title>
    @vite(['resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
    @include('owner.partials.navbar')
    <div class="d-flex" style="height: calc(100vh - 56px);">
        @include('owner.partials.sidebar')
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

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

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".toggle-password").forEach(function(button) {
                button.addEventListener("click", function() {
                    const input = document.getElementById(this.dataset.target);
                    const icon = this.querySelector("i");

                    if (input.type === "password") {
                        input.type = "text";
                        icon.classList.remove("bi-eye");
                        icon.classList.add("bi-eye-slash");
                    } else {
                        input.type = "password";
                        icon.classList.remove("bi-eye-slash");
                        icon.classList.add("bi-eye");
                    }
                });
            });
        });
    </script>
</body>

</html>
