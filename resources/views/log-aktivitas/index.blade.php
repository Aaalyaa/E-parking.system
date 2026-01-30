@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Log Aktivitas Sistem" />

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>User</th>
                <th>Peran</th>
                <th>Aksi</th>
                <th>Deskripsi</th>
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

{{ $logs->links('pagination::bootstrap-5') }}

@endsection
