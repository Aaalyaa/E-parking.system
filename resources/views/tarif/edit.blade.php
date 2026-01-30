@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Tipe Tarif Dasar">

        <form action="{{ route('tarif.update', $tarif) }}" method="POST">
            @csrf
            @method('PUT')
            <x-form.select name="id_tipe_kendaraan" label="Tipe Kendaraan" :options="$tipeKendaraans->pluck('nama_tipe', 'id')" :value="$tarif->id_tipe_kendaraan"
                placeholder="Pilih Tipe Kendaraan" required />

            <x-form.input type="number" name="durasi_minimal" label="Durasi Minimal (jam)" :value="$tarif->durasi_minimal" required />

            <x-form.input type="number" name="durasi_maksimal" label="Durasi Maksimal (jam)" :value="$tarif->durasi_maksimal" required />

            <x-form.input type="number" name="harga" label="Harga" :value="$tarif->harga" required />

            <x-form-action :cancel-route="route('tarif.index')" />
        </form>

    </x-page.form>
@endsection
