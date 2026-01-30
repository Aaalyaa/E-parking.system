@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Area Parkir">

        <form action="{{ route('area.update', $area) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-form.input name="nama_area" label="Nama Area" :value="$area->nama_area" required />

            <x-form.select name="id_lokasi_area" label="Lokasi Area" :options="$lokasi_areas->pluck('lokasi_area', 'id')" :value="$area->id_lokasi_area"
                placeholder="Pilih Lokasi" required />

            <x-form.file name="foto" label="Foto Area" :preview="$area->foto" />

            <x-form-action :cancel-route="route('area.index')" />
        </form>

    </x-page.form>
@endsection
