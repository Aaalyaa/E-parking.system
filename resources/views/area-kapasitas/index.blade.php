@extends(auth()->user()->layout())

@section('content')
<h1>Kapasitas Area Parkir</h1>

@if(auth()->user()->role->peran === 'admin')
    <a href="{{ route('area-kapasitas.create') }}" class="btn btn-primary mb-3">
        Tambah Kapasitas Area
    </a>
@endif

<table border="1">
    <thead>
        <tr>
            <th>Lokasi Area</th>
            <th>Nama Area</th>
            <th>Tipe Kendaraan</th>
            <th>Kapasitas</th>
            @if(auth()->user()->role->peran === 'admin')
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

            @if(auth()->user()->role->peran === 'admin')
            <td>
                <a href="{{ route('area-kapasitas.edit', $kapasitasArea) }}"
                   class="btn btn-warning">Edit</a>

                <form action="{{ route('area-kapasitas.destroy', $kapasitasArea) }}"
                      method="POST" style="display:inline;">
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
@endsection