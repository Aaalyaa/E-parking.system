@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Data Kendaraan">

        <form action="{{ route('data-kendaraan.update', $dataKendaraan) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form.select name="id_member" label="Nama Pemilik" :options="$members" :value="$dataKendaraan->id_member" :select2="true"
                required />

            <x-form.input name="plat_nomor" label="Plat Kendaraan" :value="$dataKendaraan->plat_nomor" required />

            <x-form.select name="id_tipe_kendaraan" label="Tipe Kendaraan" :options="$tipeKendaraans" :value="$dataKendaraan->id_tipe_kendaraan"
                :select2="true" required />


            <x-form-action :cancel-route="route('data-kendaraan.index')" />
        </form>

    </x-page.form>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                allowClear: true
            });
        });
    </script>
@endpush
