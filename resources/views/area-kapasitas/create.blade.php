@extends(auth()->user()->layout())

@section('content')
<h1>Tambah Kapasitas Area</h1>

        <a href="{{ route('area-kapasitas.index') }}">Kembali</a>

        <form action="{{ route('area-kapasitas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_lokasi_area">Lokasi Area</label>
                <select name="id_lokasi_area" id="id_lokasi_area" class="form-control" required>
                    <option value="">Pilih Lokasi Area</option>
                    @foreach ($lokasiAreas as $lokasiArea)
                        <option value="{{ $lokasiArea->id }}">{{ $lokasiArea->lokasi_area }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_area">Area</label>
                <select name="id_area" id="id_area" class="form-control" required disabled>
                    <option value="">Pilih Area</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_tipe_kendaraan">Tipe Kendaraan</label>
                <select name="id_tipe_kendaraan" id="id_tipe_kendaraan" class="form-control" required>
                    <option value="">Pilih Tipe Kendaraan</option>
                    @foreach ($tipeKendaraans as $tipeKendaraan)
                        <option value="{{ $tipeKendaraan->id }}">{{ $tipeKendaraan->nama_tipe }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="number" name="kapasitas" id="kapasitas" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
@endsection
@push('scripts')
<script>
document.getElementById('id_lokasi_area').addEventListener('change', function () {
    const lokasiId = this.value;
    const areaSelect = document.getElementById('id_area');

    areaSelect.innerHTML = '<option value="">Pilih Area</option>';
    areaSelect.disabled = true;

    if (lokasiId) {
        fetch(`/area/by-lokasi/${lokasiId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(area => {
                    const option = document.createElement('option');
                    option.value = area.id;
                    option.textContent = area.nama_area;
                    areaSelect.appendChild(option);
                });
                areaSelect.disabled = false;
            });
    }
});
</script>
@endpush