@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Data Kendaraan" :action-route="$canCreate ? route('data-kendaraan.create') : null" action-label="Tambah Kendaraan" />

    <x-page.filter>
        <form method="GET" action="{{ route('data-kendaraan.index') }}" class="row g-2">
            <div class="col-md-3">
                <input type="text" name="nama" class="form-control" placeholder="Nama Pemilik"
                    value="{{ request('nama') }}">
            </div>

            <div class="col-md-3">
                <input type="text" name="plat" class="form-control" placeholder="Plat Nomor"
                    value="{{ request('plat') }}">
            </div>

            <div class="col-md-3">
                <select name="tipe" class="form-select">
                    <option value="">Semua Tipe Kendaraan</option>
                    @foreach ($tipeKendaraan as $tipe)
                        <option value="{{ $tipe->id }}" {{ request('tipe') == $tipe->id ? 'selected' : '' }}>
                            {{ $tipe->nama_tipe }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-outline-primary w-100">
                    Filter
                </button>
            </div>

            <div class="col-md-1">
                <a href="{{ route('data-kendaraan.index') }}" class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>
        </form>
    </x-page.filter>

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>Nama Pemilik</th>
                <th>Plat Nomor</th>
                <th>Tipe Kendaraan</th>
                @if (auth()->user()->role->peran === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($dataKendaraan as $kendaraan)
                <tr>
                    <td>{{ $kendaraan->member->nama_pemilik }}</td>
                    <td>{{ $kendaraan->plat_nomor }}</td>
                    <td>{{ $kendaraan->tipe_kendaraan->nama_tipe }}</td>
                    @if (auth()->user()->role->peran === 'admin')
                        <td>
                            <x-table.action>
                                <a href="{{ route('data-kendaraan.edit', $kendaraan->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('data-kendaraan.destroy', $kendaraan->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data kendaraan ini?')">Hapus</button>
                                </form>
                            </x-table.action>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </x-table.wrapper>
@endsection
