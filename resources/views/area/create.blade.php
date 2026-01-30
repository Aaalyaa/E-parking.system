@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Area Parkir">

        <form action="{{ route('area.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form.input name="nama_area" label="Nama Area" required />

            <x-form.select name="id_lokasi_area" label="Lokasi Area" :options="$lokasi_areas->pluck('lokasi_area', 'id')" placeholder="Pilih Lokasi" required />

            <x-form.file name="foto" label="Foto Area" />

            <x-form-action :cancel-route="route('area.index')" />
        </form>
        
    </x-page.form>
@endsection
