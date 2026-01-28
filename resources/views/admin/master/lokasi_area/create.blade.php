@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <h4 class="fw-bold">Tambah Lokasi Area</h4>
        </div>

        <div class="card shadow-sm col-md-6">
            <div class="card-body">
                <form action="{{ route('admin.master.lokasi_area.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Lokasi Area</label>
                        <input type="text" name="lokasi_area"
                            class="form-control @error('lokasi_area') is-invalid @enderror" value="{{ old('lokasi_area') }}"
                            required>

                        @error('lokasi_area')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>

                        <a href="{{ route('admin.master.lokasi_area.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
