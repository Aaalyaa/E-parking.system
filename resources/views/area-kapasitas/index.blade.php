@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Area Parkir" :action-route="route('area.create')" action-label="Tambah Kapasitas Area" />

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>Lokasi Area</th>
                <th>Nama Area</th>
                <th>Tipe Kendaraan</th>
                <th>Kapasitas</th>
                @if (auth()->user()->role->peran === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($kapasitasAreas as $kapasitasArea)
                <tr>
                    <td>{{ $kapasitasArea->lokasiArea->lokasi_area }}</td>
                    <td>{{ $kapasitasArea->area->nama_area }}</td>
                    <td>{{ $kapasitasArea->tipeKendaraan->nama_tipe }}</td>
                    <td>{{ $kapasitasArea->kapasitas }}</td>

                    @if (auth()->user()->role->peran === 'admin')
                        <td>
                            <x-table.action>
                                <a href="{{ route('area-kapasitas.edit', $kapasitasArea) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('area-kapasitas.destroy', $kapasitasArea) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </x-table.action>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </x-table.wrapper>
@endsection
