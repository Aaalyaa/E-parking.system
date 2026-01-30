@extends(auth()->user()->layout())

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Log Aktivitas Sistem</h3>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">

                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>User</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                            <th>Deskripsi</th>
                            <th>IP</th>
                        </tr>
                    </thead>
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
                                <td colspan="7" class="text-center">
                                    Tidak ada data log
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $logs->links() }}
            </div>
        </div>

    </div>
@endsection
