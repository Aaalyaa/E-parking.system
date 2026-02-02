@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Area Parkir">

        <form action="{{ route('area.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form.input name="nama_area" label="Nama Area" required />

            <x-form.select name="id_lokasi_area" label="Lokasi Area" :options="$lokasi_areas->pluck('lokasi_area', 'id')" placeholder="Pilih Lokasi" required />

            <x-form.file name="foto" label="Foto Area" />

            <img id="previewFoto" src="#" class="img-thumbnail mt-2 d-none" style="max-width: 200px;">

            <x-form-action :cancel-route="route('area.index')" />
        </form>

    </x-page.form>
@endsection
@push('scripts')
<script>
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const file = e.target.files[0]
    const preview = document.getElementById('previewFoto')

    if (!file) return

    preview.src = URL.createObjectURL(file)
    preview.classList.remove('d-none')
})
</script>
@endpush