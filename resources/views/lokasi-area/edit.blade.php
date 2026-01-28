@extends(auth()->user()->layout())

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <h4 class="fw-bold">Edit Lokasi Area</h4>
        </div>

        <div class="card shadow-sm col-md-6">
            <div class="card-body">
                <form action="{{ route('lokasi-area.update', $lokasiArea) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Lokasi Area</label>
                        <input type="text" name="lokasi_area"
                            class="form-control @error('lokasi_area') is-invalid @enderror" value="{{ $lokasiArea->lokasi_area }}" required>

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

                        <a href="{{ route('lokasi-area.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
