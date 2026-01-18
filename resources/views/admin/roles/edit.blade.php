@extends('admin.layout')

@section('content')
<h2>Sunting Peran</h2>

<a href="{{ route('admin.roles.index') }}">Kembali</a>

<form action="{{ route('admin.roles.update', $role) }}" method="POST">
    @method("PUT")
    @csrf
    <div>
        <label for="peran">Nama Peran:</label>
        <input type="text" id="peran" name="peran" value="{{ $role->peran }}" required>
    </div>
    <button type="submit">Simpan</button>
</form>
@endsection