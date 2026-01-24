@extends('admin.layout')

@section('content')
        <h1>Sunting Lokasi Area</h1>

        <a href="{{ route('admin.master.lokasi_area.index') }}">Kembali</a>

        <form action="{{ route('admin.master.lokasi_area.update', $lokasiArea) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_lokasi_area">Nama Lokasi Area</label>
                <input type="text" name="lokasi_area" id="nama_lokasi_area" class="form-control" value="{{ $lokasiArea->lokasi_area }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
@endsection