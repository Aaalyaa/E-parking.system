@extends(auth()->user()->layout())

@section('content')
    <x-page-header 
        title="Lokasi Area"
        :action-route="$canCreate ? '#' : null"
        action-label="Tambah Lokasi Area"
        action-id="btnTambah"
    />

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM CREATE / EDIT --}}
    <div id="formCreate" class="card mb-4" style="display: none;">
        <div class="card-body">

            <form id="lokasiForm"
                action="{{ route('lokasi-area.store') }}"
                method="POST"
                class="d-flex gap-3 align-items-end">

                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="flex-grow-1">
                    <x-form.input
                        name="lokasi_area"
                        label="Lokasi Area"
                        id="lokasiInput"
                        required
                    />
                </div>

                <div class="d-flex gap-2 mb-3">
                    <button type="submit" class="btn btn-outline-primary">
                        Simpan
                    </button>

                    <button type="button" class="btn btn-secondary" id="btnBatal">
                        Batal
                    </button>
                </div>
            </form>

        </div>
    </div>

    {{-- TABEL DATA --}}
    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>Nama Lokasi Area</th>
                @if (auth()->user()->role->peran === 'admin')
                    <th width="150">Aksi</th>
                @endif
            </tr>
        </x-table.thead>

        <tbody>
            @foreach ($lokasiAreas as $lokasiArea)
                <tr>
                    <td>{{ $lokasiArea->lokasi_area }}</td>

                    @if (auth()->user()->role->peran === 'admin')
                        <td>
                            <x-table.action>

                                {{-- EDIT --}}
                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm btn-edit"
                                    data-nama="{{ $lokasiArea->lokasi_area }}"
                                    data-url="{{ route('lokasi-area.update', $lokasiArea) }}">
                                    Edit
                                </button>

                                {{-- HAPUS --}}
                                <form
                                    action="{{ route('lokasi-area.destroy', $lokasiArea) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus lokasi area ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>

                            </x-table.action>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </x-table.wrapper>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const btnTambah   = document.getElementById('btnTambah')
    const formWrapper = document.getElementById('formCreate')
    const form        = document.getElementById('lokasiForm')
    const input       = document.getElementById('lokasiInput')
    const methodInput = document.getElementById('formMethod')
    const btnBatal    = document.getElementById('btnBatal')

    btnTambah.addEventListener('click', e => {
        e.preventDefault()

        if (formWrapper.style.display === 'block' && input.value.trim() !== '') {
            if (!confirm('Form sedang diisi. Yakin ingin menambah data baru?')) {
                return
            }
        }

        resetForm()
        formWrapper.style.display = 'block'
    })

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', () => {
            formWrapper.style.display = 'block'
            input.value = btn.dataset.nama
            form.action = btn.dataset.url
            methodInput.value = 'PUT'
        })
    })

    form.addEventListener('submit', e => {
        const mode = methodInput.value === 'POST'
            ? 'menyimpan'
            : 'memperbarui'

        if (!confirm(`Yakin ingin ${mode} data lokasi area ini?`)) {
            e.preventDefault()
        }
    })

    btnBatal.addEventListener('click', () => {
        if (input.value.trim() !== '') {
            if (!confirm('Perubahan belum disimpan. Yakin batal?')) {
                return
            }
        }

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
