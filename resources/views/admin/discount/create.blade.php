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
                    <x-input id="discount" label="Diskon" name="discount" type="number" required />
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
                <div class="mx-auto mt-6 w-full md:w-1/3 lg:w-1/2">
                    <x-button type="submit">Tambah Diskon</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            function percentageInput() {
                $('#discount').on('input', function() {
                    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                });
                $('#discount').on('input', function() {
                    if (parseFloat($(this).val()) > 100) {
                        $(this).val('');
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Nilai tidak boleh lebih dari 100',
                        });
                    }
                });
            }

            function nominalInput() {
                $('#discount').on('input', function() {
                    var value = $(this).val();
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });
            }

            $(function() {
                $('#discount').on('input', function() {
                    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                    let value = $(this).val();
                    if (parseFloat(value) > 100) {
                        $(this).val('');
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Nilai tidak boleh lebih dari 100',
                        });
                    }
                });

                let tipPercentageTag = '<p class="mt-2 text-gray-500">Gunakan . (titik) untuk desimal</p>';
                let tipNominalTag = '<p class="mt-2 text-gray-500">Hanya angka</p>';

                $('#discount_type').on('change', function() {
                    $('#discount').val('');
                    $('#discount').off('input');
                    if ($(this).val() == 'percentage') {
                        $('#discount').next().remove();
                        $('#discount').after(tipPercentageTag);
                        percentageInput();
                    } else {
                        $('#discount').next().remove();
                        $('#discount').after(tipNominalTag);
                        nominalInput();
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
