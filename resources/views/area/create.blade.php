@extends(auth()->user()->layout())

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <h4 class="fw-bold">Tambah Area Parkir</h4>
        </div>

        <div class="card shadow-sm col-md-6">
            <div class="card-body">
                <form action="{{ route('area.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Area</label>
                        <input type="text" name="nama_area" id="nama_area" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <select name="id_lokasi_area" id="id_lokasi_area" class="form-control" required>
                            <option value="">Pilih Lokasi</option>
                            @foreach ($lokasi_areas as $lokasi_area)
                                <option value="{{ $lokasi_area->id }}">{{ $lokasi_area->lokasi_area }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>

                        <a href="{{ route('area.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
