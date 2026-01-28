@extends(auth()->user()->layout())

@section('content')
        <h1>Data Kendaraan</h1>

        <a href="{{ route('data-kendaraan.create') }}" class="btn btn-primary">Tambah Data Kendaraan</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Pemilik</th>
                    <th>Tipe Kendaraan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataKendaraan as $kendaraan)
                <tr>
                    <td>{{ $kendaraan->plat_nomor }}</td>
                    <td>{{ $kendaraan->pemilik }}</td>
                    <td>{{ $kendaraan->tipe_kendaraan->nama_tipe }}</td>
                    <td>
                        <a href="{{ route('data-kendaraan.edit', $kendaraan->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('data-kendaraan.destroy', $kendaraan->id) }}" method="POST" style="display:inline;">
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