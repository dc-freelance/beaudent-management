<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Layanan', 'url' => route('admin.treatment.index')],
        ['name' => 'Ubah Layanan', 'url' => ''],
    ]" title="Ubah Layanan" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.treatment.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <x-input id="name" label="Nama" name="name" required value="{{ $data->name }}" />
                    <x-input id="code" label="Kode" name="code" required value="{{ $data->code }}" />
                    <div>
                        <p>Jenis</p>
                        <div class="flex flex-wrap gap-6 mt-6">
                            <div class="flex items-center space-x-2">
                                <input type="radio" name="is_parent" id="parent" value="parent" checked
                                    class="radio radio-primary" {{ $data->parent_id == null ? 'checked' : '' }}>
                                <label for="parent">Utama</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" name="is_parent" id="chiild" value="child"
                                    class="radio radio-primary" {{ $data->parent_id != null ? 'checked' : '' }}>
                                <label for="chiild">Turunan</label>
                            </div>
                        </div>
                    </div>
                    <div class="hidden">
                        <label for="parent_list" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Pilih Layanan Utama
                        </label>
                        <select id="parent_list"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="parent_id">
                            @foreach ($parents as $parent)
                                @if ($parent->id == $data->id)
                                    @continue
                                @endif
                                <option value="{{ $parent->id }}"
                                    {{ $data->parent_id == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}
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
                            <option value="1" {{ $data->is_control == true ? 'selected' : '' }}>Ya</option>
                            <option value="0" {{ $data->is_control == false ? 'selected' : '' }}>Tidak</option>
                        </select>
                    </div>
                    <div>
                        <label for="treatment_categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Pilih Kategori Layanan
                        </label>
                        <select id="treatment_categories"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="treatment_category_id">
                            @foreach ($treatment_categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $data->treatment_category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-input id="price" label="Harga" name="price" type="text" required
                            value="Rp. {{ number_format(old('price', $data->price), 0, ',', '.') }}"/>
                </div>
                <div class="mt-6">
                    <x-button type="submit">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                let isParent = $('input[name="is_parent"]:checked').val();
                if (isParent === 'child') {
                    $('#parent_list').parent().removeClass('hidden');
                    $('#control_list').parent().removeClass('hidden');
                }

                $('input[name="is_parent"]').on('change', function() {
                    let value = $(this).val();
                    if (value === 'child') {
                        $('#parent_list').parent().removeClass('hidden');
                        $('#control_list').parent().removeClass('hidden');
                    } else {
                        $('#parent_list').parent().addClass('hidden');
                        $('#control_list').parent().addClass('hidden');
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                var priceInput = document.getElementById('price');
                priceInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });
            });
        </script>
    @endpush
</x-app-layout>
