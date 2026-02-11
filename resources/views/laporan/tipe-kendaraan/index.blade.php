@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Laporan Tipe Kendaraan" :action-route="route('laporan.tipe-kendaraan.pdf', request()->query())"
        action-label="Cetak PDF" action-class="btn-success" />

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Tipe Kendaraan</th>
                        <th>Jumlah Kendaraan</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $item)
                        <tr>
                            <td>{{ ucfirst($item->nama_tipe) }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
