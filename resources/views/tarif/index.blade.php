@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Tipe Tarif Dasar" :action-route="$canCreate ? route('tarif.create') : null" action-label="Tambah Tipe Tarif" />

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>Tipe Kendaraan</th>
                <th>Durasi Minimal</th>
                <th>Durasi Maksimal</th>
                <th>Harga</th>
                @if (auth()->user()->role->peran === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($tarifs as $tarif)
                <tr>
                    <td>{{ $tarif->tipe_kendaraan->nama_tipe }}</td>
                    <td>{{ $tarif->durasi_minimal }}</td>
                    <td>{{ $tarif->durasi_maksimal }}</td>
                    <td>{{ number_format($tarif->harga, 0, ',', '.') }}</td>
                    @if (auth()->user()->role->peran === 'admin')
                        <td>
                            <x-table.action>
                                <a href="{{ route('tarif.edit', $tarif) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('tarif.destroy', $tarif) }}" method="POST" style="display:inline;">
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
