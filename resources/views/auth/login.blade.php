<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | E-Parking</title>
    @vite(['resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="login-bg">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4 bg-white">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h4 class="fw-bold">E-Parking</h4>
                        <small class="text-muted">Silakan login terlebih dahulu</small>
                    </div>

                    <form method="POST" action="/login">
                        @csrf

                        <div class="mb-3">
                            <input type="text" name="username"
                                class="form-control rounded-3 @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" placeholder="Username" required autofocus>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" id="password" name="password"
                                    class="form-control rounded-start-3 @error('password') is-invalid @enderror"
                                    placeholder="Password" required>

                                <button type="button" class="btn btn-outline-dark rounded-end-3"
                                    id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>

                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-dark w-100 mt-3">Login</button>
                    </form>

                </div>
            </div>

            <p class="text-center text-light mt-3 small">
                © {{ date('Y') }} E-Parking System
            </p>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggle = document.getElementById("togglePassword");
            const password = document.getElementById("password");

            if (!toggle || !password) return;

            toggle.addEventListener("click", function() {
                const isHidden = password.type === "password";

                password.type = isHidden ? "text" : "password";
                toggle.innerHTML = isHidden ?
                    '<i class="bi bi-eye-slash"></i>' :
                    '<i class="bi bi-eye"></i>';
            });
        });
    </script>
</body>

</html>
