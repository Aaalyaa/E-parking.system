@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Data Kendaraan">

        <form action="{{ route('data-kendaraan.update', $dataKendaraan) }}" method="POST">
            @csrf
            @method('PUT')
            <x-form.input name="plat_nomor" label="Plat Kendaraan" :value="$dataKendaraan->plat_nomor" required />

            <x-form.input name="pemilik" label="Pemilik Kendaraan" :value="$dataKendaraan->pemilik" required />

            <x-form.select name="id_tipe_kendaraan" label="Tipe Kendaraan" :options="$tipeKendaraans->pluck('nama_tipe', 'id')" :value="$dataKendaraan->id_tipe_kendaraan"
                placeholder="Pilih Tipe Kendaraan" />

            <x-form-action :cancel-route="route('data-kendaraan.index')" />
        </form>

    </x-page.form>
@endsection
