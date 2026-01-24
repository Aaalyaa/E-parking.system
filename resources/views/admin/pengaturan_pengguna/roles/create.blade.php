@extends('admin.layout')

@section('content')
<h2>Tambah Peran</h2>

<a href="{{ route('admin.pengaturan_pengguna.roles.index') }}">Kembali</a>
<form action="{{ route('admin.pengaturan_pengguna.roles.store') }}" method="POST">
    @csrf
    <div>
        <label for="peran">Nama Peran:</label>
        <input type="text" id="peran" name="peran" required>
    </div>
    <button type="submit">Simpan</button>
</form>
@endsection