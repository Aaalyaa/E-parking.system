@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Tambah Akun Pengguna">

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <x-form.input name="username" label="Username" required />

            <x-form.input name="password" label="Password" required />

            <x-form.select name="id_role" label="Peran" :options="$roles->pluck('peran', 'id')"
                placeholder="Pilih Peran" required />

            <x-form-action :cancel-route="route('users.index')" />
        </form>

    </x-page.form>
@endsection
