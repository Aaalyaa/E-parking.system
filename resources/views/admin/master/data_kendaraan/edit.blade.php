@extends('admin.layout')

@section('content')
        <h1>Sunting Data Kendaraan</h1>

        <a href="{{ route('admin.master.data_kendaraan.index') }}">Kembali</a>

        <form action="{{ route('admin.master.data_kendaraan.update', $dataKendaraan) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="plat_nomor">Plat Nomor</label>
                <input type="text" name="plat_nomor" id="plat_nomor" class="form-control" value="{{ $dataKendaraan->plat_nomor }}" required>
            </div>

            <div class="form-group">
                <label for="pemilik">Pemilik</label>
                <input type="text" name="pemilik" id="pemilik" class="form-control" value="{{ $dataKendaraan->pemilik }}">
            </div>

            <div class="form-group">
                <label for="id_tipe_kendaraan">Tipe Kendaraan</label>
                <select name="id_tipe_kendaraan" id="id_tipe_kendaraan" class="form-control" required>
                    <option value="">Pilih Tipe Kendaraan</option>
                    @foreach ($tipeKendaraans as $tipe)
                        <option value="{{ $tipe->id }}" {{ $dataKendaraan->id_tipe_kendaraan == $tipe->id ? 'selected' : '' }}>{{ $tipe->nama_tipe }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
@endsection