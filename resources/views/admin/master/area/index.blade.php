@extends('admin.layout')

@section('content')
        <h1>Area Parkir</h1>

        <a href="{{ route('admin.master.area.create') }}" class="btn btn-primary">Tambah Area Parkir</a>
        
        <table border="1">
            <thead>
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
                            @if($area->foto)
                                <img src="{{ asset('storage/' . $area->foto) }}" alt="Foto Area" width="100">
                            @else
                                Tidak ada foto
                            @endif
                        <td>
                            <a href="{{ route('admin.master.area.edit', $area) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.master.area.destroy', $area) }}" method="POST" style="display:inline;">
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