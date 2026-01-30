@extends(auth()->user()->layout())

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Kapasitas Area Parkir</h4>
            @if (auth()->user()->role->peran === 'admin')
                <a href="{{ route('area-kapasitas.create') }}" class="btn btn-primary">
                    Tambah Kapasitas Area
                </a>
            @endif
        </div>


        <div class="card shadow-sm">
            <div class="card-body p-0">

                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Lokasi Area</th>
                            <th>Nama Area</th>
                            <th>Tipe Kendaraan</th>
                            <th>Kapasitas</th>
                            @if (auth()->user()->role->peran === 'admin')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kapasitasAreas as $kapasitasArea)
                            <tr>
                                <td>{{ $kapasitasArea->lokasiArea->lokasi_area }}</td>
                                <td>{{ $kapasitasArea->area->nama_area }}</td>
                                <td>{{ $kapasitasArea->tipeKendaraan->nama_tipe }}</td>
                                <td>{{ $kapasitasArea->kapasitas }}</td>

                                @if (auth()->user()->role->peran === 'admin')
                                    <td>
                                        <a href="{{ route('area-kapasitas.edit', $kapasitasArea) }}"
                                            class="btn btn-warning">Edit</a>

                                        <form action="{{ route('area-kapasitas.destroy', $kapasitasArea) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
