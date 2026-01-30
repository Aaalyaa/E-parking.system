@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Lokasi Area" :action-route="route('lokasi-area.create')" action-label="Tambah Lokasi Area" />

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
                            <a href="{{ route('lokasi-area.edit', $lokasiArea) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

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
