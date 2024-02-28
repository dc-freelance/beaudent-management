<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Konfigurasi Shift', 'url' => route('admin.config-shift.index')],
        ['name' => 'Ubah', 'url' => ''],
    ]" title="Ubah Konfigurasi Shift" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.config-shift.update', $data->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <x-input id="name" label="Nama" type="text" name="name" required :value="$data->name" />
                <x-input id="start_time" label="Jam Mulai" type="time" name="start_time" required :value="$data->start_time" />
                <x-input id="end_time" label="Jam Berakhir" type="time" name="end_time" required
                    :value="$data->end_time" />
                <div class="mx-auto mt-6 w-full md:w-1/3 lg:w-1/2">
                    <x-button type="submit" class="mt-6">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
