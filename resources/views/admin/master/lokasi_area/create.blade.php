@extends('admin.layout')

@section('content')
        <h1>Tambah Lokasi Area</h1>

        <a href="{{ route('admin.master.lokasi_area.index') }}">Kembali</a>

        <form action="{{ route('admin.master.lokasi_area.store') }}" method="POST"">
            @csrf
            <div class="form-group">
                <label for="nama_lokasi_area">Nama Lokasi Area</label>
                <input type="text" name="lokasi_area" id="lokasi_area" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
@endsection