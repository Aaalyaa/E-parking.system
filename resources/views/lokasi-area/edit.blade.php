@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Lokasi Area">

        <form action="{{ route('lokasi-area.update', $lokasiArea) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <x-form.input name="lokasi_area" label="Lokasi Area" :value="$lokasiArea->lokasi_area" required />
            </div>

            <x-form-action :cancel-route="route('lokasi-area.index')" />

        </form>

    </x-page.form>
@endsection
