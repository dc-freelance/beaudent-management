<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Diskon', 'url' => route('admin.discount.index')],
        ['name' => 'Tambah Diskon', 'url' => ''],
    ]" title="Tambah Diskon" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.discount.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <x-input id="name" label="Nama" name="name" required />
                    <div>
                        <label for="discount_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tipe Diskon
                        </label>
                        <select id="discount_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="discount_type">
                            <option value="Percentage">Persentase</option>
                            <option value="Nominal">Nominal</option>
                        </select>
                    </div>
                    <x-input id="discount" label="Diskon" name="discount" type="text" required />
                    <x-input id="start_date" label="Awal Periode Diskon" name="start_date" type="date" required />
                    <x-input id="end_date" label="Akhir Periode Diskon" name="end_date" type="date" required />
                    <div>
                        <label for="control_list" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Status
                        </label>
                        <select id="control_list"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="is_active">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6">
                    <x-button type="submit">Tambah Diskon</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const discountType = document.getElementById('discount_type');
                const discountInput = document.getElementById('discount');

                function updateDiscountSymbol() {
                    if (discountType.value === 'Percentage') {
                        discountInput.value = discountInput.value.replace(/[^0-9]/g, '');
                        discountInput.setAttribute('placeholder', '0%');
                    } else if (discountType.value === 'Nominal') {
                        discountInput.value = discountInput.value.replace(/[^0-9]/g, '');
                        discountInput.setAttribute('placeholder', 'Rp. 0');
                    }
                }

                updateDiscountSymbol();

                discountType.addEventListener('change', function() {
                    updateDiscountSymbol();
                });

                discountInput.addEventListener('input', function() {
                    if (discountType.value === 'Percentage') {
                        if (parseInt(this.value) > 100) {
                            this.value = '100';
                        }
                        this.value = this.value.replace(/\D/g, '') + '%';
                    } else if (discountType.value === 'Nominal') {
                        this.value = 'Rp. ' + this.value.replace(/\D/g, '').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                    }
                });
            });

        </script>
    @endpush

</x-app-layout>
