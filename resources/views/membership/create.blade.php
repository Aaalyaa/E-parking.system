@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Membership">

        <form action="{{ route('membership.store') }}" method="POST">
            @csrf
            <x-form.input name="nama_pemilik" label="Nama Pemilik Kendaraan" required />

            <x-form.select name="id_tipe_member" label="Tipe Member" :options="$tipeMembers->pluck('tipe_member', 'id')" placeholder="Pilih Tipe Member"
                required />

            <x-form-action :cancel-route="route('membership.index')" />
        </form>

    </x-page.form>
@endsection
