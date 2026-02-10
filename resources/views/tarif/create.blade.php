@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Tipe Tarif Dasar">

        <form action="{{ route('tarif.store') }}" method="POST">
            @csrf
            <x-form.select name="id_tipe_kendaraan" label="Tipe Kendaraan" :options="$tipeKendaraans->pluck('nama_tipe', 'id')" placeholder="Pilih Tipe Kendaraan"
                required />

            <x-form.input type="number" name="tarif_per_jam" label="Tarif Per Jam" required />

            <x-form-action :cancel-route="route('tarif.index')" />
        </form>

    </x-page.form>
@endsection
