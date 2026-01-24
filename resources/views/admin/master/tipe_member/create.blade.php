@extends('admin.layout')

@section('content')
        <h1>Tambah Tipe Member</h1>

        <a href="{{ route('admin.master.tipe_member.index') }}">Kembali</a>

        <form action="{{ route('admin.master.tipe_member.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tipe_member">Tipe Member</label>
                <input type="text" name="tipe_member" id="tipe_member" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="masa_berlaku_bulanan">Masa Berlaku (Bulan)</label>
                <input type="number" name="masa_berlaku_bulanan" id="masa_berlaku_bulanan" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="diskon_persen">Diskon Persen</label>
                <input type="number" name="diskon_persen" id="diskon_persen" step="0.01" min="0" max="100" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
@endsection