@extends(auth()->user()->layout())

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Area</h4>
            <a href="{{ route('area.create') }}" class="btn btn-primary">Tambah Area Parkir</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">

                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Area</th>
                            <th>Lokasi</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areas as $area)
                            <tr>
                                <td>{{ $area->nama_area }}</td>
                                <td>{{ $area->lokasiArea->lokasi_area }}</td>
                                <td>
                                    @if ($area->foto)
                                        <img src="{{ asset('storage/' . $area->foto) }}" alt="Foto Area"
                                            class="img-thumbnail" style="width: 100px; height: 70px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('area.edit', $area) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('area.destroy', $area) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
