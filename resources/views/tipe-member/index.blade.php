@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Tipe Membership" :action-route="$canCreate ? route('tipe-member.create') : null" action-label="Tambah Tipe Membership" />

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>Tipe</th>
                <th>Masa Berlaku (Bulan)</th>
                <th>Harga</th>
                <th>Diskon Persen</th>
                @if (auth()->user()->role->peran === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($tipeMembers as $tipeMember)
                <tr>
                    <td>{{ $tipeMember->tipe_member }}</td>
                    <td>{{ $tipeMember->masa_berlaku_bulanan }}</td>
                    <td>{{ number_format($tipeMember->harga, 0, ',', '.') }}</td>
                    <td>{{ rtrim(rtrim(number_format($tipeMember->diskon_persen, 2, ',', '.'), '0'), ',') }}%</td>
                    @if (auth()->user()->role->peran === 'admin')
                        <td>
                            <x-table.action>
                                <a href="{{ route('tipe-member.edit', $tipeMember) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('tipe-member.destroy', $tipeMember) }}" method="POST"
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
