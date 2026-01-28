@extends(auth()->user()->layout())

@section('content')
        <h1>Data Member</h1>

        <a href="{{ route('membership.create') }}" class="btn btn-primary">Tambah Member</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Tipe Member</th>
                    <th>Tanggal Bergabung</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td>{{ $member->data_kendaraan->plat_nomor }}</td>
                        <td>{{ $member->tipe_member->tipe_member }}</td>
                        <td>{{ $member->tanggal_bergabung }}</td>
                        <td>{{ $member->tanggal_kadaluarsa }}</td>
                        <td>
                            <form action="{{ route('membership.destroy', $member) }}" method="POST" style="display:inline;">
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