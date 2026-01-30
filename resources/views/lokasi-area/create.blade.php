@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Lokasi Area">

        <form action="{{ route('lokasi-area.store') }}" method="POST">
            @csrf

            <x-form.input name="lokasi_area" label="Lokasi Area" required />

            <x-form-action :cancel-route="route('lokasi-area.index')" />

        </form>
        
    </x-page.form>
@endsection
