@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Tipe Tarif Dasar">

        <form action="{{ route('tarif.store') }}" method="POST">
            @csrf
            <x-form.select name="id_tipe_kendaraan" label="Tipe Kendaraan" :options="$tipeKendaraans->pluck('nama_tipe', 'id')" placeholder="Pilih Tipe Kendaraan"
                required />

            <x-form.input type="number" name="durasi_minimal" label="Durasi Minimal (jam)" required />

            <x-form.input type="number" name="durasi_maksimal" label="Durasi Maksimal (jam)" required />

            <x-form.input type="number" name="harga" label="Tarif Dasar" required />

            <x-form-action :cancel-route="route('tarif.index')" />
        </form>

    </x-page.form>
@endsection
