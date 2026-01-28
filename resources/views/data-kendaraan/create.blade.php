@extends(auth()->user()->layout())

@section('content')
        <h1>Tambah Data Kendaraan</h1>

        <a href="{{ route('data-kendaraan.index') }}">Kembali</a>

        <form action="{{ route('data-kendaraan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="plat_nomor">Plat Nomor</label>
                <input type="text" name="plat_nomor" id="plat_nomor" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="pemilik">Pemilik</label>
                <input type="text" name="pemilik" id="pemilik" class="form-control">
            </div>

            <div class="form-group">
                <label for="id_tipe_kendaraan">Tipe Kendaraan</label>
                <select name="id_tipe_kendaraan" id="id_tipe_kendaraan" class="form-control" required>
                    <option value="">Pilih Tipe Kendaraan</option>
                    @foreach ($tipeKendaraans as $tipe)
                        <option value="{{ $tipe->id }}">{{ $tipe->nama_tipe }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
@endsection