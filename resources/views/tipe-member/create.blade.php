@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Tipe Membership">
                <form action="{{ route('tipe-member.store') }}" method="POST">
                    @csrf
                    <x-form.input name="tipe_member" label="Tipe" required />

                    <x-form.input type="number" name="masa_berlaku_bulanan" label="Masa Berlaku (Bulan)" required />

                    <x-form.input type="number" name="harga" label="Tarif Dasar" required />

                    <x-form.input type="number" name="diskon_persen" step="0.01" min="0" max="100"
                        label="Diskon Persen" required />

                    <x-form-action :cancel-route="route('tipe-member.index')" />
        </form>

    </x-page.form>
@endsection
