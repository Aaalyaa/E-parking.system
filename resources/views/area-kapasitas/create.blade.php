@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Area Kapasitas">

        <form action="{{ route('area-kapasitas.store') }}" method="POST">
            @csrf
            <x-form.select name="id_lokasi_area" id="id_lokasi_area" label="Lokasi Area" :options="$lokasiAreas->pluck('lokasi_area', 'id')"
                placeholder="Pilih Lokasi Area" required />

            <x-form.select name="id_area" id="id_area" label="Area" :options="[]" placeholder="Pilih Area" required
                disabled />

            <x-form.select name="id_tipe_kendaraan" label="Tipe Kendaraan" :options="$tipeKendaraans->pluck('nama_tipe', 'id')"
                placeholder="Pilih Tipe Kendaraan" required />

            <x-form.input type="number" name="kapasitas" label="Kapasitas" required />

            <x-form-action :cancel-route="route('area-kapasitas.index')" />
        </form>

    </x-page.form>
@endsection
@push('scripts')
    <script>
        document.getElementById('id_lokasi_area').addEventListener('change', function() {
            const lokasiId = this.value;
            const areaSelect = document.getElementById('id_area');

            areaSelect.innerHTML = '<option value="">Pilih Area</option>';
            areaSelect.disabled = true;

            if (lokasiId) {
                fetch(`/api/area/by-lokasi/${lokasiId}`)
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
