@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Kapasitas Area">
        
        <form action="{{ route('area-kapasitas.update', $kapasitasArea) }}" method="POST">
            @csrf
            @method('PUT')
            <x-form.select name="id_lokasi_area" label="Lokasi Area" :options="$lokasiAreas->pluck('lokasi_area', 'id')" :value="$kapasitasArea->id_lokasi_area"
                placeholder="Pilih Lokasi" required />

            <x-form.select name="id_area" label="Area" :options="$areas->pluck('nama_area', 'id')" :value="$kapasitasArea->id_area" placeholder="Pilih Area"
                required />

            <x-form.select name="id_tipe_kendaraan" label="Tipe Kendaraan" :options="$tipeKendaraans->pluck('nama_tipe', 'id')" :value="$kapasitasArea->id_tipe_kendaraan"
                placeholder="Pilih Tipe Kendaraan" required />

            <x-form.input type="number" name="kapasitas" label="Kapasitas" :value="$kapasitasArea->kapasitas" required />

            <x-form-action :cancel-route="route('area-kapasitas.index')" />
        </form>

    </x-page.form>
@endsection