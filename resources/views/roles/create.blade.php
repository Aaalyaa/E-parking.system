@extends(auth()->user()->layout())

@section('content')
<h2>Tambah Peran</h2>

<a href="{{ route('roles.index') }}">Kembali</a>
<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div>
        <label for="peran">Nama Peran:</label>
        <input type="text" id="peran" name="peran" required>
    </div>
    <button type="submit">Simpan</button>
</form>
@endsection