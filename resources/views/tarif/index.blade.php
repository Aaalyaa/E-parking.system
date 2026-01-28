@extends(auth()->user()->layout())

@section('content')
        <h1>Data Kendaraan</h1>

        <a href="{{ route('tarif.create') }}" class="btn btn-primary">Tambah Tarif</a>

        <table border="1">
            <thead>
                <tr>
                    <th>Tipe Kendaraan</th>
                    <th>Durasi Minimal</th>
                    <th>Durasi Maksimal</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tarifs as $tarif)
                <tr>
                    <td>{{ $tarif->tipe_kendaraan->nama_tipe }}</td>
                    <td>{{ $tarif->durasi_minimal }}</td>
                    <td>{{ $tarif->durasi_maksimal }}</td>
                    <td>{{ $tarif->harga }}</td>
                    <td><a href="{{ route('tarif.edit', $tarif) }}" class="btn btn-warning">Edit</a> | 
                        <form action="{{ route('tarif.destroy', $tarif) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form></td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endsection