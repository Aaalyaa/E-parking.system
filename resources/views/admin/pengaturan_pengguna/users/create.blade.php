@extends('admin.layout')

@section('content')
<h2>Tambah Akun Pengguna</h2>

<a href="{{ route('admin.pengaturan_pengguna.users.index') }}">Kembali</a>

<form action="{{ route('admin.pengaturan_pengguna.users.store') }}" method="POST">
    @csrf
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="id_role">Peran:</label>
        <select id="id_role" name="id_role" required>
            <option value="">-- Pilih Peran --</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->peran }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Simpan</button>
</form>

@endsection