@extends('admin.layout')

@section('content')
        <h1>Sunting Data Kendaraan</h1>

        <a href="{{ route('admin.master.tarif.index') }}">Kembali</a>

        <form action="{{ route('admin.master.tarif.update', $tarif) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id_tipe_kendaraan">Tipe Kendaraan</label>
                <select name="id_tipe_kendaraan" id="id_tipe_kendaraan" class="form-control" required>
                    <option value="">Pilih Tipe Kendaraan</option>
                    @foreach ($tipeKendaraans as $tipe)
                        <option value="{{ $tipe->id }}" {{ $tarif->id_tipe_kendaraan == $tipe->id ? 'selected' : '' }}>{{ $tipe->nama_tipe }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="durasi_minimal">Durasi Minimal (jam)</label>
                <input type="number" name="durasi_minimal" id="durasi_minimal" class="form-control" value="{{ $tarif->durasi_minimal }}" required>
            </div>

            <div class="form-group">
                <label for="durasi_maksimal">Durasi Maksimal (jam)</label>
                <input type="number" name="durasi_maksimal" id="durasi_maksimal" class="form-control" value="{{ $tarif->durasi_maksimal }}" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ $tarif->harga }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
@endsection