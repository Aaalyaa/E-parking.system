@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Tipe Kendaraan">

        <form action="{{ route('tipe-kendaraan.store') }}" method="POST">
            @csrf
            <x-form.input name="kode_tipe" label="Kode Tipe" required />

            <x-form.input name="nama_tipe" label="Nama Tipe" required />

            <x-form.textarea name="deskripsi" label="Deskripsi Area" rows="4"
                hint="Opsional. Jelaskan area parkir secara singkat." />

            <x-form-action :cancel-route="route('tipe-kendaraan.index')" />
        </form>

    </x-page.form>
@endsection
