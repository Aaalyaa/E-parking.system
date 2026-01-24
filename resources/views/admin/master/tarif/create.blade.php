@extends('admin.layout')

@section('content')
        <h1>Tambah Tarif Kendaraan</h1>

        <a href="{{ route('admin.master.tarif.index') }}">Kembali</a>

        <form action="{{ route('admin.master.tarif.store') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="id_tipe_kendaraan">Tipe Kendaraan</label>
                <select name="id_tipe_kendaraan" id="id_tipe_kendaraan" class="form-control" required>
                    <option value="">Pilih Tipe Kendaraan</option>
                    @foreach ($tipeKendaraans as $tipe)
                        <option value="{{ $tipe->id }}">{{ $tipe->nama_tipe }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="durasi_minimal">Durasi Minimal (jam)</label>
                <input type="number" name="durasi_minimal" id="durasi_minimal" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="durasi_maksimal">Durasi Maksimal (jam)</label>
                <input type="number" name="durasi_maksimal" id="durasi_maksimal" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
@endsection