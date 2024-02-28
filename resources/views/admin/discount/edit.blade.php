<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Diskon', 'url' => route('admin.discount.index')],
        ['name' => 'Ubah Diskon', 'url' => ''],
    ]" title="Ubah Diskon" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.discount.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <x-input id="name" label="Nama" name="name" required value="{{ $data->name }}" />
                    <div>
                        <label for="discount_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tipe Diskon
                        </label>
                        <select id="discount_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="discount_type">
                            <option value="Percentage" {{ $data->discount_type == 'Percentage' ? 'selected' : '' }}>
                                Persentase</option>
                            <option value="Nominal" {{ $data->discount_type == 'Nominal' ? 'selected' : '' }}>Nominal
                            </option>
                        </select>
                    </div>
                    <x-input id="discount" label="Diskon" name="discount" type="text" required
                        value="{{ $data->discount_type == 'Percentage'
                            ? number_format($data->discount, 1)
                            : // remove decimal after comma if it's 0, and remove .
                                'Rp. ' . number_format(old('discount', $data->discount), 0, ',', '.') }}" />
                    <x-input id="start_date" label="Awal Periode Diskon" name="start_date" type="date" required
                        :value="$data->start_date" />
                    <x-input id="end_date" label="Akhir Periode Diskon" name="end_date" type="date" required
                        :value="$data->end_date" />
                    <div>
                        <label for="control_list" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Kontrol
                        </label>
                        <select id="control_list"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="is_active">
                            <option value="1" {{ $data->is_active == true ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $data->is_active == false ? 'selected' : '' }}>Tidak Aktif
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mt-6">
                    <x-button type="submit">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            function percentageInput() {
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
                    value = value.replace(/\D/g, '');
                    value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                    $(this).val(value);
                });
            }

            $(function() {
                $('#discount').on('input', function() {
                    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                });

                let tipPercentageTag = '<p class="mt-2 text-gray-500">Gunakan . (titik) untuk desimal</p>';
                let tipNominalTag = '<p class="mt-2 text-gray-500">Hanya angka</p>';

                let discount_type = '{{ $data->discount_type }}';
                if (discount_type == 'Percentage') {
                    $('#discount').after(tipPercentageTag);
                    percentageInput();
                } else {
                    $('#discount').after(tipNominalTag);
                    nominalInput();
                }

                $('#discount_type').on('change', function() {
                    $('#discount').val('');
                    $('#discount').off('input');
                    if ($(this).val() == 'Percentage') {
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
