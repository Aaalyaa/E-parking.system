@extends('admin.layout')

@section('content')
        <h1>Tambah Tipe Kendaraan</h1>

        <a href="{{ route('admin.master.tipe_kendaraan.index') }}">Kembali</a>

        <form action="{{ route('admin.master.tipe_kendaraan.store') }}" method="POST">
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
            <div class="form-group">
                <label for="ukuran_slot">Ukuran Slot</label>
                <input type="text" name="ukuran_slot" id="ukuran_slot" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
@endsection