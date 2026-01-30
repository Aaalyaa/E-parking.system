@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Data Kendaraan" :action-route="route('data-kendaraan.create')" action-label="Tambah Kendaraan" />

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>Plat Nomor</th>
                <th>Pemilik</th>
                <th>Tipe Kendaraan</th>
                <th>Status Membership</th>
                <th>Aksi</th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($dataKendaraan as $kendaraan)
                <tr>
                    <td>{{ $kendaraan->plat_nomor }}</td>
                    <td>{{ $kendaraan->pemilik }}</td>
                    <td>{{ $kendaraan->tipe_kendaraan->nama_tipe }}</td>
                    <td>
                        <span class="badge {{ $kendaraan->memberAktif ? 'bg-success' : 'bg-secondary' }}">
                            {{ $kendaraan->status_member_text }}
                        </span>
                    </td>
                    <td>
                        <x-table.action>
                            <a href="{{ route('data-kendaraan.edit', $kendaraan->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('data-kendaraan.destroy', $kendaraan->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </x-table.action>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table.wrapper>
@endsection
