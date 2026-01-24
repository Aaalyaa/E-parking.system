@extends('admin.layout')

@section('content')
        <h1>Tambah Member</h1>

        <a href="{{ route('admin.kendaraan_dan_member.membership.index') }}">Kembali</a>

        <form action="{{ route('admin.kendaraan_dan_member.membership.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_data_kendaraan">Data Kendaraan</label>
                <select name="id_data_kendaraan" id="id_data_kendaraan" class="form-control" required>
                    <option value="">Pilih Data Kendaraan</option>
                    @foreach ($dataKendaraan as $data)
                        <option value="{{ $data->id }}">{{ $data->plat_nomor }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_tipe_member">Tipe Member</label>
                <select name="id_tipe_member" id="id_tipe_member" class="form-control" required>
                    <option value="">Pilih Tipe Member</option>
                    @foreach ($tipeMembers as $tipeMember)
                        <option value="{{ $tipeMember->id }}">{{ $tipeMember->tipe_member }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
@endsection