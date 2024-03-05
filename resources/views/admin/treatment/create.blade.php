<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Layanan', 'url' => route('admin.treatment.index')],
        ['name' => 'Tambah Layanan', 'url' => ''],
    ]" title="Tambah Layanan" />

    <div class="lg:w-full">
        <x-card-container>
            <form action="{{ route('admin.treatment.store') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <div class=" grid lg:grid-cols-2 grid-cols-1 gap-5">
                        <x-input id="name" label="Nama" name="name" required />
                        <x-input id="code" label="Kode" name="code" required />
                        <div>
                            <p>Jenis</p>
                            <div class="flex flex-wrap gap-6 mt-6">
                                <div class="flex items-center space-x-2">
                                    <input type="radio" name="is_parent" id="parent" value="parent" checked
                                        class="radio radio-primary">
                                    <label for="parent">Utama</label>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input type="radio" name="is_parent" id="chiild" value="child"
                                        class="radio radio-primary">
                                    <label for="chiild">Turunan</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="treatment_categories"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Pilih Kategori Layanan
                            </label>
                            <select id="treatment_categories"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                name="treatment_category_id">
                                @foreach ($treatment_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">
                        <div class="hidden">
                            <label for="parent_list" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Pilih Layanan Utama
                            </label>
                            <select id="parent_list"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                name="parent_id">
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="hidden">
                            <label for="control_list" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Kontrol
                            </label>
                            <select id="control_list"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                name="is_control">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">
               
                        <x-input format="nominal" id="price" label="Harga" name="price" type="text" required />
    
                    </div>
                </div>
                <div class="max-md:w-2/3 max-md:mx-auto md:w-1/3 lg:w-1/3 xl:w-1/3 pt-5">
                    <x-button type="submit">Tambah Layanan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                // check if child is checked
                $('input[name="is_parent"]').on('change', function() {
                    if ($(this).val() === 'child') {
                        $('#parent_list').parent().removeClass('hidden');
                        $('#control_list').parent().removeClass('hidden');
                    } else {
                        $('#parent_list').parent().addClass('hidden');
                        $('#control_list').parent().addClass('hidden');
                        $('#control_list').val('0');
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
