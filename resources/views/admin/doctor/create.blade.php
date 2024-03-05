<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Dokter', 'url' => route('admin.doctor.index')],
        ['name' => 'Tambah Dokter', 'url' => ''],
    ]" title="Tambah Dokter" />

    <div class="lg:w-full">
        <x-card-container>
            <form action="{{ route('admin.doctor.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid gap-5 items-center lg:grid-cols-2 grid-cols-1">
                    <x-input id="name" label="Nama Lengkap" name="name" required />
                    <x-select id="category_id" label="Kategori" name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select>
                   
                        <x-input id="email" label="Email" name="email" type="email" required />
                        <x-input id="phone_number" label="No. Telp" name="phone_number" type="number" required />
           
                    <x-input id="join_date" label="Tgl. Bergabung" name="join_date" type="date" required />
                </div>
                <div class="max-md:w-2/3 max-md:mx-auto md:w-1/3 lg:w-1/3 xl:w-1/3 pt-5">
                    <x-button type="submit">Tambah Dokter</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
