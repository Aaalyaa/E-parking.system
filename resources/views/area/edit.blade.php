@extends(auth()->user()->layout())

@section('content')
        <h1>Sunting Area Parkir</h1>

        <a href="{{ route('area.index') }}">Kembali</a>

        <form action="{{ route('area.update', $area) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_area">Nama Area</label>
                <input type="text" name="nama_area" id="nama_area" class="form-control" value="{{ $area->nama_area }}" required>
            </div>

            <div class="form-group">
                <label for="id_lokasi_area">Lokasi</label>
                <select name="id_lokasi_area" id="id_lokasi_area" class="form-control" required>
                    <option value="">Pilih Lokasi</option>
                    @foreach ($lokasi_areas as $lokasi_area)
                        <option value="{{ $lokasi_area->id }}" {{ $area->id_lokasi_area == $lokasi_area->id ? 'selected' : '' }}>{{ $lokasi_area->lokasi_area }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
                @if($area->foto)
                    <img src="{{ asset('storage/' . $area->foto) }}" alt="Foto Area" width="100">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
@endsection