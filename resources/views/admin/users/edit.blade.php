@extends('admin.layout')

@section('content')
<h2>Sunting Akun Pengguna</h2>

<a href="{{ route('admin.users.index') }}">Kembali</a>

<form action="{{ route('admin.users.update', $user) }}" method="POST">
    @method("PUT")
    @csrf
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="{{ $user->username }}" required>
    </div>
    <div>
        <label for="id_role">Peran:</label>
        <select id="id_role" name="id_role" required>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->peran }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Simpan</button>
</form>

@endsection