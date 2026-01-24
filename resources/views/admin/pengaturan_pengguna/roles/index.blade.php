@extends('admin.layout')

@section('content')
    <h1>Daftar Peran</h1>

    <a href="{{ route('admin.pengaturan_pengguna.roles.create') }}">Tambah Peran</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->peran }}</td>
                    <td>
                        <a href="{{ route('admin.pengaturan_pengguna.roles.edit', $role->id) }}">Edit</a>
                        <form action="{{ route('admin.pengaturan_pengguna.roles.destroy', $role->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection