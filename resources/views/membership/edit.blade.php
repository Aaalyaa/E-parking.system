@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Membership">
        <form action="{{ route('membership.update', $member) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form.input label="Nama Pemilik" name="nama_pemilik" :value="$member->nama_pemilik" required />

            <x-form.select label="Tipe Member" name="id_tipe_member" :options="$tipeMembers" :value="$member->id_tipe_member" required />

            <x-form.input label="Tanggal Bergabung" name="tanggal_bergabung" type="date" :value="$member->tanggal_bergabung->format('Y-m-d')" readonly class="bg-light" />

            <x-form.input label="Tanggal Kadaluarsa" name="tanggal_kadaluarsa" type="date" :value="$member->tanggal_kadaluarsa->format('Y-m-d')" readonly class="bg-light" />

            <x-form-action :cancel-route="route('membership.index')" />
        </form>
        </x-form>
    @endsection
