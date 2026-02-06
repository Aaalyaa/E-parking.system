@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Area Parkir" :action-route="$canCreate ? route('area.create') : null" action-label="Tambah Area" />

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>Nama Area</th>
                <th>Lokasi</th>
                <th>Foto</th>
                @if (auth()->user()->role->peran === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($areas as $area)
                <tr>
                    <td>{{ $area->nama_area }}</td>
                    <td>{{ $area->lokasiArea->lokasi_area }}</td>
                    <td>
                        @if ($area->foto)
                            <img src="{{ asset('storage/' . $area->foto) }}" alt="Foto Area" class="img-thumbnail"
                                style="width: 100px; height: 70px; object-fit: cover;">
                        @else
                            <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </td>
                    @if (auth()->user()->role->peran === 'admin')
                    <td>
                        <x-table.action>
                            <a href="{{ route('area.edit', $area) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('area.destroy', $area) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </x-table.action>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </x-table.wrapper>
@endsection
