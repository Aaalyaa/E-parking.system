@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Data Kendaraan">

        <form action="{{ route('data-kendaraan.update', $dataKendaraan) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form.select name="id_member" label="Nama Pemilik" :options="$members" :value="$dataKendaraan->id_member" :select2="true"
                required />

            <x-form.input name="plat_nomor" label="Plat Kendaraan" :value="$dataKendaraan->plat_nomor" required maxlength="11"
                pattern="^[A-Z]{1,2} [0-9]{1,4} [A-Z]{1,3}$" />

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

        document.addEventListener("DOMContentLoaded", function() {
            const platInput = document.querySelector("input[name='plat_nomor']");

            if (platInput) {
                platInput.addEventListener("input", function(e) {
                    let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, "");

                    let depan = value.substring(0, 2).replace(/[^A-Z]/g, "");
                    let tengah = value.substring(depan.length, depan.length + 4).replace(/[^0-9]/g, "");
                    let belakang = value.substring(depan.length + tengah.length, depan.length + tengah
                        .length + 3).replace(/[^A-Z]/g, "");

                    let formatted = depan;
                    if (tengah) formatted += " " + tengah;
                    if (belakang) formatted += " " + belakang;

                    e.target.value = formatted;
                });
            }
        });
    </script>
@endpush
