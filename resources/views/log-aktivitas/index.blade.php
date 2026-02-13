@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Log Aktivitas Sistem" />

    <x-page.filter>
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <input type="text" name="username" class="form-control" placeholder="Cari username..."
                    value="{{ request('username') }}">
            </div>

            <div class="col-md-4">
                <select name="peran" class="form-select">
                    <option value="">-- Semua Peran --</option>
                    <option value="admin" {{ request('peran') == 'admin' ? 'selected' : '' }}>ADMIN</option>
                    <option value="petugas" {{ request('peran') == 'petugas' ? 'selected' : '' }}>PETUGAS</option>
                    <option value="owner" {{ request('peran') == 'owner' ? 'selected' : '' }}>OWNER</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-outline-primary w-100">Filter</button>
            </div>

            <div class="col-md-2">
                <a href="{{ route('log-aktivitas.index') }}" class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>
        </form>
    </x-page.filter>

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>User</th>
                <th>Peran</th>
                <th width="10%">Aksi</th>
                <th width="20%">Deskripsi</th>
                <th>Perubahan</th>
                <th>IP</th>
            </tr>
        </x-table.thead>
        <tbody>
            @forelse ($logs as $log)
                <tr>
                    <td>{{ $loop->iteration + $logs->firstItem() - 1 }}</td>
                    <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $log->user->username ?? '-' }}</td>
                    <td>{{ strtoupper($log->peran) }}</td>
                    <td>
                        <span class="badge bg-info">
                            {{ $log->aksi }}
                        </span>
                    </td>
                    <td>{{ $log->deskripsi }}</td>
                    <td>
                        @if ($log->data_before || $log->data_after)
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#detail{{ $log->id }}">
                                Lihat
                            </button>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $log->ip_address }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Tidak ada data log
                    </td>
                </tr>
            @endforelse
        </tbody>
    </x-table.wrapper>

    @foreach ($logs as $log)
        @if ($log->data_before || $log->data_after)
            <div class="modal fade" id="detail{{ $log->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Detail Perubahan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <h6>Data Sebelum</h6>
                            @if ($log->data_before)
                                <pre class="bg-light p-3 rounded small">
{{ json_encode($log->data_before, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
                            </pre>
                            @else
                                <p class="text-muted">-</p>
                            @endif

                            <hr>

                            <h6>Data Sesudah</h6>
                            @if ($log->data_after)
                                <pre class="bg-light p-3 rounded small">
{{ json_encode($log->data_after, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
                            </pre>
                            @else
                                <p class="text-muted">-</p>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        @endif
    @endforeach

    {{ $logs->links('pagination::bootstrap-5') }}
@endsection
