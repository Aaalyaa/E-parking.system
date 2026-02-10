@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Tipe Tarif Dasar">

        <form action="{{ route('tarif.update', $tarif) }}" method="POST">
            @csrf
            @method('PUT')
            <x-form.select name="id_tipe_kendaraan" label="Tipe Kendaraan" :options="$tipeKendaraans->pluck('nama_tipe', 'id')" :value="$tarif->id_tipe_kendaraan"
                placeholder="Pilih Tipe Kendaraan" required />

            <x-form.input type="number" name="tarif_per_jam" label="Tarif Per Jam" :value="$tarif->tarif_per_jam" required />

            <x-form-action :cancel-route="route('tarif.index')" />
        </form>

    </x-page.form>
@endsection
