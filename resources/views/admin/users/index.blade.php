@extends('admin.layout')

@section('content')
<h2>Data Akun Pengguna</h2>

<a href="{{ route('admin.users.create') }}">Tambah User</a>

<table border="1">
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->role->peran }}</td>
        <td>
            <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection