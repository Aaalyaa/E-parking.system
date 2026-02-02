@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Lokasi Area" action-route="#" action-label="Tambah Lokasi Area" />

    @if (session('success'))
        <div class="alert alert-success"> {{ session('success') }} </div>
    @endif

    <div id="formCreate" class="card mb-4" style="display: none;">
        <div class="card-body">

            <form id="lokasiForm" action="{{ route('lokasi-area.store') }}" method="POST"
                class="d-flex gap-3 align-items-end">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="flex-grow-1">
                    <x-form.input name="lokasi_area" label="Lokasi Area" id="lokasiInput" required />
                </div>

                <div class="d-flex gap-2 mb-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" id="btnBatal">Batal</button>
                </div>
            </form>

        </div>
    </div>

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>Nama Lokasi Area</th>
                <th width="150">Aksi</th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($lokasiAreas as $lokasiArea)
                <tr>
                    <td>{{ $lokasiArea->lokasi_area }}</td>
                    <td>
                        <x-table.action>
                            <button type="button" class="btn btn-warning btn-sm btn-edit" data-id="{{ $lokasiArea->id }}"
                                data-nama="{{ $lokasiArea->lokasi_area }}"
                                data-url="{{ route('lokasi-area.update', $lokasiArea) }}">
                                Edit
                            </button>

                            <form action="{{ route('lokasi-area.destroy', $lokasiArea) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data lokasi area ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </x-table.action>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table.wrapper>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const btnTambah = document.getElementById('btnTambah')
    const formWrapper = document.getElementById('formCreate')
    const form = document.getElementById('lokasiForm')
    const input = document.getElementById('lokasiInput')
    const methodInput = document.getElementById('formMethod')
    const btnBatal = document.getElementById('btnBatal')

    // MODE TAMBAH
    btnTambah.addEventListener('click', e => {
        e.preventDefault()
        resetForm()
        formWrapper.style.display = 'block'
    })

    // MODE EDIT
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', () => {
            formWrapper.style.display = 'block'
            input.value = btn.dataset.nama
            form.action = btn.dataset.url
            methodInput.value = 'PUT'
        })
    })

    // BATAL
    btnBatal.addEventListener('click', () => {
        resetForm()
        formWrapper.style.display = 'none'
    })

    function resetForm() {
        input.value = ''
        form.action = "{{ route('lokasi-area.store') }}"
        methodInput.value = 'POST'
    }
})
</script>
@endpush
