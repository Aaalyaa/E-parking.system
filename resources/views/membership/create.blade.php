@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Membership">

        <form action="{{ route('membership.store') }}" method="POST">
            @csrf
            <x-form.select name="id_data_kendaraan" label="Plat Kendaraan" :options="$dataKendaraan->pluck('plat_nomor', 'id')" placeholder="Pilih Plat Kendaraan"
                :select2="true" required />

            <x-form.select name="id_tipe_member" label="Tipe Member" :options="$tipeMembers->pluck('tipe_member', 'id')" placeholder="Pilih Tipe Member"
                required />

            <x-form-action :cancel-route="route('membership.index')" />
        </form>

    </x-page.form>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                allowClear: true,
                placeholder: function() {
                    return $(this).data('placeholder');
                }
            });
        });
    </script>
@endpush
