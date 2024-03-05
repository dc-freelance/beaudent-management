<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Profil', 'url' => route('admin.password.index')],
        ['name' => 'Ubah Password', 'url' => ''],
    ]" title="Ubah Password" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf
                @method('put')
                <div class="space-y-6">
                    <div>
                        <x-input id="update_password_current_password" label="Password Lama" name="current_password" type="password" autocomplete="current-password" required />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
                    <div>
                        <x-input id="update_password_password" label="Password Baru" name="password" type="password" autocomplete="new-password" required />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>
                    <div>
                        <x-input id="update_password_password_confirmation" label="Konfirmasi Password Baru" name="password_confirmation" type="password" autocomplete="current-password" required />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
                <div class="max-md:w-2/3 max-md:mx-auto md:w-1/2 lg:w-1/3 xl:w-1/3 pt-5">
                    <x-button type="submit">Ubah Password</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

</x-app-layout>
