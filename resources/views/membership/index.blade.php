@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Data Membership" :action-route="route('membership.create')" action-label="Tambah Membership" />

    <x-table.wrapper>
        <x-table.thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Tipe Member</th>
                    <th>Tanggal Bergabung</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Aksi</th>
                </tr>
            </x-table.thead>
            <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td>{{ $member->data_kendaraan->plat_nomor }}</td>
                        <td>{{ $member->tipe_member->tipe_member }}</td>
                        <td>{{ $member->tanggal_bergabung }}</td>
                        <td>{{ $member->tanggal_kadaluarsa }}</td>
                        <td>
                            <x-table.action>
                            <form action="{{ route('membership.destroy', $member) }}" method="POST" style="display:inline;">
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