@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Tipe Member">

        <form action="{{ route('tipe-member.update', $tipeMember) }}" method="POST">
            @csrf
            @method('PUT')
            <x-form.input name="tipe_member" label="Tipe Member" :value="$tipeMember->tipe_member" required />

            <x-form.input type="number" name="masa_berlaku_bulanan" label="Masa Berlaku (Bulan)" :value="$tipeMember->masa_berlaku_bulanan" required />

            <x-form.input type="number" name="harga" label="Tarif Dasar" :value="$tipeMember->harga" required />

            <x-form.input type="number" name="diskon_persen" step="0.01" min="0" max="100"
                label="Diskon Persen" :value="$tipeMember->diskon_persen" required />

            <x-form-action :cancel-route="route('tipe-member.index')" />
        </form>

    </x-page.form>
@endsection
