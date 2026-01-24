@extends('admin.layout')

@section('content')
        <h1>Kapasitas Area Parkir</h1>

        <a href="{{ route('admin.master.kapasitas_area.create') }}" class="btn btn-primary">Tambah Kapasitas Area</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Lokasi Area</th>
                    <th>Nama Area</th>
                    <th>Tipe Kendaraan</th>
                    <th>Kapasitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kapasitasAreas as $kapasitasArea)
                    <tr>
                        <td>{{ $kapasitasArea->lokasiArea->lokasi_area }}</td>
                        <td>{{ $kapasitasArea->area->nama_area }}</td>
                        <td>{{ $kapasitasArea->tipeKendaraan->nama_tipe }}</td>
                        <td>{{ $kapasitasArea->kapasitas }}</td>
                        <td>
                            <a href="{{ route('admin.master.kapasitas_area.edit', $kapasitasArea) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.master.kapasitas_area.destroy', $kapasitasArea) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection