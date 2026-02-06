@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Data Kendaraan">

        <form action="{{ route('data-kendaraan.store') }}" method="POST">
            @csrf

            <x-form.select name="id_member" label="Nama Pemilik (Membership)" :options="$members"
                placeholder="Pilih nama pemilik" :select2="true" required />

            <x-form.input name="plat_nomor" label="Plat Kendaraan" required />

            <x-form.select name="id_tipe_kendaraan" label="Tipe Kendaraan" :options="$tipeKendaraans"
                placeholder="Pilih / ketik kode atau nama tipe kendaraan" :select2="true" required />

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
