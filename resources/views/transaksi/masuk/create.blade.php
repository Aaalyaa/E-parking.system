@extends(auth()->user()->layout())

@section('content')
<div class="container">

    <h4 class="fw-bold mb-4">Transaksi Kendaraan Masuk</h4>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">

            <form action="{{ route('transaksi.masuk') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Kendaraan</label>
                    <select name="id_data_kendaraan" class="form-select" required>
                        <option value="">-- Pilih Kendaraan --</option>
                        @foreach ($dataKendaraan as $kendaraan)
                            <option value="{{ $kendaraan->id }}">
                                {{ $kendaraan->plat_nomor }} - {{ $kendaraan->tipe_kendaraan->nama_tipe }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi Area</label>
                    <select id="lokasi_area" class="form-select">
                        <option value="">-- Pilih Lokasi --</option>
                        @foreach ($lokasiAreas as $lokasi)
                            <option value="{{ $lokasi->id }}">
                                {{ $lokasi->lokasi_area }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Area Parkir</label>
                    <select name="id_area" id="area" class="form-select" disabled required>
                        <option value="">-- Pilih Area --</option>
                    </select>
                    <small class="text-muted">
                        Area akan muncul setelah lokasi dipilih
                    </small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        Simpan Transaksi Masuk
                    </button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.getElementById('lokasi_area').addEventListener('change', function () {
    const lokasiId = this.value;
    const areaSelect = document.getElementById('area');

    areaSelect.innerHTML = '<option value="">-- Pilih Area --</option>';
    areaSelect.disabled = true;

    if (!lokasiId) return;

    fetch(`/api/area/by-lokasi/${lokasiId}`)
        .then(res => res.json())
        .then(data => {
            data.forEach(area => {
                const opt = document.createElement('option');
                opt.value = area.id;
                opt.textContent = area.nama_area;
                areaSelect.appendChild(opt);
            });
            areaSelect.disabled = false;
        });
});
</script>
@endpush
