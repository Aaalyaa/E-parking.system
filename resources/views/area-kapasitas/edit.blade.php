@extends(auth()->user()->layout())

@section('content')
        <h1>Edit Kapasitas Area</h1>

        <a href="{{ route('area-kapasitas.index') }}">Kembali</a>
        <form action="{{ route('area-kapasitas.update', $kapasitasArea) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id_lokasi_area">Lokasi Area</label>
                <select name="id_lokasi_area" id="id_lokasi_area" class="form-control" required>
                    <option value="">Pilih Lokasi Area</option>
                    @foreach ($lokasiAreas as $lokasiArea)
                        <option value="{{ $lokasiArea->id }}" {{ $kapasitasArea->id_lokasi_area == $lokasiArea->id ? 'selected' : '' }}>{{ $lokasiArea->lokasi_area }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_area">Area</label>
                <select name="id_area" id="id_area" class="form-control" required>
                    <option value="">Pilih Area</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ $kapasitasArea->id_area == $area->id ? 'selected' : '' }}>{{ $area->nama_area }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_tipe_kendaraan">Tipe Kendaraan</label>
                <select name="id_tipe_kendaraan" id="id_tipe_kendaraan" class="form-control" required>
                    <option value="">Pilih Tipe Kendaraan</option>
                    @foreach ($tipeKendaraans as $tipeKendaraan)
                        <option value="{{ $tipeKendaraan->id }}" {{ $kapasitasArea->id_tipe_kendaraan == $tipeKendaraan->id ? 'selected' : '' }}>{{ $tipeKendaraan->nama_tipe }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="number" name="kapasitas" id="kapasitas" class="form-control" value="{{ $kapasitasArea->kapasitas }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
@endsection