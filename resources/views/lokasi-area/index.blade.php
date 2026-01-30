@extends(auth()->user()->layout())

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Lokasi Area</h4>
            <a href="{{ route('lokasi-area.create') }}" class="btn btn-primary">Tambah Lokasi Area</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">

                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Lokasi Area</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lokasiAreas as $lokasiArea)
                            <tr>
                                <td>{{ $lokasiArea->lokasi_area }}</td>
                                <td>
                                    <a href="{{ route('lokasi-area.edit', $lokasiArea) }}"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('lokasi-area.destroy', $lokasiArea) }}"
                                        method="POST" style="display:inline;" 
                                        onsubmit="return confirm('Yakin ingin menghapus data lokasi area ini?')">
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
