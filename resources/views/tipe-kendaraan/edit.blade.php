@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Tipe Kendaraan">
        
        <form action="{{ route('tipe-kendaraan.update', $tipeKendaraan) }}" method="POST">
            @csrf
            @method('PUT')
            <x-form.input name="kode_tipe" label="Kode Tipe" :value="$tipeKendaraan->kode_tipe" readonly />

            <x-form.input name="nama_tipe" label="Nama Tipe" :value="$tipeKendaraan->nama_tipe" required />

            <x-form.textarea name="deskripsi" label="Deskripsi" :value="$tipeKendaraan->deskripsi" rows="4"
                hint="Opsional. Jelaskan tipe kendaraan secara singkat." />

            <x-form-action :cancel-route="route('tipe-kendaraan.index')" />
        </form>

    </x-page.form>
@endsection
