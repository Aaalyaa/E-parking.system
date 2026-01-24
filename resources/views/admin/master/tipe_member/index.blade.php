@extends('admin.layout')

@section('content')
        <h1>Tipe Member</h1>

        <a href="{{ route('admin.master.tipe_member.create') }}" class="btn btn-primary">Tambah Tipe Member</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Tipe Member</th>
                    <th>Masa Berlaku (Bulan)</th>
                    <th>Harga</th>
                    <th>Diskon Persen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipeMembers as $tipeMember)
                    <tr>
                        <td>{{ $tipeMember->tipe_member }}</td>
                        <td>{{ $tipeMember->masa_berlaku_bulanan }}</td>
                        <td>{{ $tipeMember->harga }}</td>
                        <td>{{ $tipeMember->diskon_persen }}</td>
                        <td>
                            <a href="{{ route('admin.master.tipe_member.edit', $tipeMember) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.master.tipe_member.destroy', $tipeMember) }}" method="POST" style="display:inline;">
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