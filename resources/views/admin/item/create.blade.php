<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Barang', 'url' => route('admin.item.index')],
        ['name' => 'Tambah Barang', 'url' => ''],
    ]" title="Tambah Barang" />

    <div class="lg:w-full">
        <x-card-container>
            <form action="{{ route('admin.item.store') }}" method="POST">
                @csrf
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">
                    <x-input id="name" label="Nama Barang" name="name" required />
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Kategori Barang
                        </label>
                        <select id="category_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="category_id">
                            @foreach ($itemCategory as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="unit_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Satuan Barang
                        </label>
                        <select id="unit_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="unit_id">
                            @foreach ($itemUnit as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <x-input id="total_stock" label="Total Stok" name="total_stock" type="number" required /> --}}
                    <x-input id="price" label="Harga" name="price" type="text" placeholder="Rp." required />
                    <div>
                        <p>Tipe Barang :</p>
                        <div class="mt-2">
                            <select id="type" name="type"
                                class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="Medicine">Obat</option>
                                <option value="BMHP">Barang Medis Habis Pakai (BMHP)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="max-md:w-2/3 max-md:mx-auto md:w-1/2 lg:w-1/3 xl:w-1/3 pt-5">
                    <x-button type="submit">Tambah Barang</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
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
