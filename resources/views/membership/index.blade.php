@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Data Membership" :action-route="$canCreate ? route('membership.create') : null" action-label="Tambah Membership" />

    <x-page.filter>
        <form method="GET" action="{{ route('tracking.index') }}" class="row g-2">
            <div class="col-md-6">
                <input type="text" name="plat" value="{{ request('plat') }}" class="form-control"
                    placeholder="Nama Pemilik">
            </div>

            <div class="col-md-3">
                <button class="btn btn-outline-primary w-100">
                    Filter
                </button>
            </div>

            <div class="col-md-3">
                <a href="{{ route('tracking.index') }}" class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>
        </form>
    </x-page.filter>

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>Nama Pemilik</th>
                <th>Tipe Member</th>
                <th>Tanggal Bergabung</th>
                <th>Tanggal Kadaluarsa</th>
                <th>Jumlah Kendaraan</th>
                <th>Status Membership</th>
                @if (auth()->user()->role->peran === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->nama_pemilik }}</td>
                    <td>{{ $member->tipe_member->tipe_member }}</td>
                    <td>{{ $member->tanggal_bergabung->format('d-m-Y') }}</td>
                    <td>{{ $member->tanggal_kadaluarsa->format('d-m-Y') }}</td>
                    <td class="text-center">
                        {{ $member->kendaraan_count }}
                    </td>
                    <td>
                        <span class="badge {{ $member->IsAktif ? 'bg-success' : 'bg-secondary' }}">
                            {{ $member->status_member_text }}
                        </span>
                    </td>
                    @if (auth()->user()->role->peran === 'admin')
                        <td>
                            <x-table.action>
                                <a href="{{ route('membership.edit', $member) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('membership.extend', $member) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm"
                                        onclick="return confirm('Perpanjang membership selama {{ $member->tipe_member->masa_berlaku_bulanan }} bulan?')">
                                        Perpanjang
                                    </button>
                                </form>

                                <form action="{{ route('membership.destroy', $member) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin Ingin Menghapus Membership Ini?')">
                                        Hapus
                                </form>
                            </x-table.action>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </x-table.wrapper>
@endsection
