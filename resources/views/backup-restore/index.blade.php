@extends(auth()->user()->layout())

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-5">
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">
                    Backup Database
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        Klik tombol di bawah untuk membuat backup database.
                    </p>
                    <form action="{{ route('backup.run') }}" method="POST">
                        @csrf
                        <button class="btn btn-success w-100">
                            Backup Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">
                    Restore Database
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        Upload file <code>.sql</code> untuk restore database.
                    </p>
                    <form action="{{ route('backup.restore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="backup_file" class="form-control mb-3" required>
                        <button class="btn btn-danger w-100">
                            Restore Database
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
