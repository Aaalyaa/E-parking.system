@extends('admin.layout')

@section('content')
        <h1>Lokasi</h1>

        <a href="{{ route('admin.master.lokasi_area.create') }}" class="btn btn-primary">Tambah Lokasi Area</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Nama Lokasi Area</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lokasiAreas as $lokasiArea)
                    <tr>
                        <td>{{ $lokasiArea->lokasi_area }}</td>
                        <td>
                            <a href="{{ route('admin.master.lokasi_area.edit', $lokasiArea) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.master.lokasi_area.destroy', $lokasiArea) }}" method="POST" style="display:inline;">
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