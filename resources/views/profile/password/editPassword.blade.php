@extends(auth()->user()->layout())

@section('content')
    <div class="container">
        <h3 class="fw-bold">User Profile</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('profile.updatePassword') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Lama</label>

                        <div class="position-relative">
                            <input type="password" class="form-control pe-5 @error('current_password') is-invalid @enderror"
                                id="current_password" name="current_password" required>

                            <button type="button" class="password-eye btn btn-link p-0" data-target="current_password"
                                aria-label="Toggle password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        @error('current_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru</label>

                        <div class="position-relative">
                            <input type="password" class="form-control pe-5 @error('new_password') is-invalid @enderror"
                                id="new_password" name="new_password" required>

                            <button type="button" class="password-eye btn btn-link p-0" data-target="new_password"
                                aria-label="Toggle password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>

                        <div class="position-relative">
                        <input type="password"
                            class="form-control pe-5 @error('new_password_confirmation') is-invalid @enderror"
                            id="new_password_confirmation" name="new_password_confirmation" required>

                            <button type="button" class="password-eye btn btn-link p-0" data-target="new_password_confirmation"
                                aria-label="Toggle password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        @error('new_password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Password</button>
                    <a href="{{ route('profile.index') }}" class="btn btn-dark">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.password-eye').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = document.getElementById(btn.dataset.target);
                const icon = btn.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('bi-eye', 'bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('bi-eye-slash', 'bi-eye');
                }
            });
        });
    </script>
@endpush
