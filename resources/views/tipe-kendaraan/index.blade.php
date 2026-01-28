@extends(auth()->user()->layout())

@section('content')
        <h1>Tipe Kendaraan</h1>

        <a href="{{ route('tipe-kendaraan.create') }}" class="btn btn-primary">Tambah Tipe Kendaraan</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Kode Tipe</th>
                    <th>Nama Tipe</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipe_kendaraan as $tipe)
                    <tr>
                        <td>{{ $tipe->kode_tipe }}</td>
                        <td>{{ $tipe->nama_tipe }}</td>
                        <td>{{ $tipe->deskripsi }}</td>
                        <td>
                            <a href="{{ route('tipe-kendaraan.edit', $tipe) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('tipe-kendaraan.destroy', $tipe) }}" method="POST" style="display:inline;">
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