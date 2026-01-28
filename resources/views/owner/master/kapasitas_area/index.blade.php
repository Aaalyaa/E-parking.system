@extends('owner.layout')

@section('content')
        <h1>Kapasitas Area Parkir</h1>

        <table border="1">
            <thead>
                <tr>
                    <th>Lokasi Area</th>
                    <th>Nama Area</th>
                    <th>Tipe Kendaraan</th>
                    <th>Kapasitas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kapasitasAreas as $kapasitasArea)
                    <tr>
                        <td>{{ $kapasitasArea->lokasiArea->lokasi_area }}</td>
                        <td>{{ $kapasitasArea->area->nama_area }}</td>
                        <td>{{ $kapasitasArea->tipeKendaraan->nama_tipe }}</td>
                        <td>{{ $kapasitasArea->kapasitas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection