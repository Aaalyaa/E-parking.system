@extends(auth()->user()->layout())

@section('content')
    <x-page.form title="Edit Akun Pengguna">

        <form action="{{ route('users.update', $user) }}" method="POST">
            @method('PUT')
            @csrf
            <x-form.input name="username" label="Username" :value="$user->username" required />

            <x-form.select name="id_role" label="Peran" :options="$roles->pluck('peran', 'id')" placeholder="Pilih Peran" :value="$user->id_role"
                required />

            <x-form-action :cancel-route="route('users.index')" />
        </form>

    </x-page.form>
@endsection
