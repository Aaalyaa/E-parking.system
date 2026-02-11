@extends(auth()->user()->layout())

@section('content')
    <div class="container">
        <x-page.form title="Edit Password">
            <form method="POST" action="{{ route('profile.updatePassword') }}">
                @csrf

                <x-form.input type="password" name="current_password" label="Password Lama" :showToggle="true" required />

                <x-form.input type="password" name="new_password" label="Password Baru" :showToggle="true" required />

                <x-form.input type="password" name="new_password_confirmation" label="Konfirmasi Password Baru"
                    :showToggle="true" required />

                <x-form-action :cancel-route="route('profile.index')" />
            </form>
        </x-page.form>
    @endsection