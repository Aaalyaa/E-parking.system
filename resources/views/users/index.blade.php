@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Akun Pengguna" :action-route="route('users.create')" action-label="Tambah Akun Pengguna" />

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role->peran }}</td>
                    <td>
                        <x-table.action>
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        </x-table.action>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table.wrapper>
@endsection
