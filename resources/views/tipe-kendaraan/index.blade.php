@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Tipe Kendaraan" :action-route="$canCreate ? route('tipe-kendaraan.create') : null" action-label="Tambah Tipe Kendaraan" />

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>Kode Tipe</th>
                <th>Nama Tipe</th>
                <th>Deskripsi</th>
                @if (auth()->user()->role->peran === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($tipe_kendaraan as $tipe)
                <tr>
                    <td>{{ $tipe->kode_tipe }}</td>
                    <td>{{ $tipe->nama_tipe }}</td>
                    <td>{{ $tipe->deskripsi }}</td>
                    @if (auth()->user()->role->peran === 'admin')
                        <td>
                            <x-table.action>
                                <a href="{{ route('tipe-kendaraan.edit', $tipe) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('tipe-kendaraan.destroy', $tipe) }}" method="POST"
                                    style="display:inline;">
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
