@extends(auth()->user()->layout())

@section('content')
        <h1>Tambah Tipe Kendaraan</h1>

        <a href="{{ route('tipe-kendaraan.index') }}">Kembali</a>

        <form action="{{ route('tipe-kendaraan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode_tipe">Kode Tipe</label>
                <input type="text" name="kode_tipe" id="kode_tipe" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nama_tipe">Nama Tipe</label>
                <input type="text" name="nama_tipe" id="nama_tipe" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
@endsection