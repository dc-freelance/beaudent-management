<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Diskon Layanan', 'url' => route('admin.discount_treatment.index')],
        ['name' => 'Ubah Diskon Layanan', 'url' => ''],
    ]" title="Ubah Diskon Layanan" />

    <div class="lg:w-full">
        <x-card-container>
            <form action="{{ route('admin.discount_treatment.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class=" grid lg:grid-cols-2 grid-cols-1 gap-5">
                    <x-select id="discount_id" label="Nama Diskon" name="discount_id" required>
                        @foreach ($data_discount as $discount)
                            <option value="{{ $discount->id }}" {{ $discount->id == $data->discount_id ? 'selected' : '' }}>
                                {{ $discount->name }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-select id="treatment_id" label="Layanan" name="treatment_id" required>
                        @foreach ($data_treatment as $treatment)
                            <option value="{{ $treatment->id }}" {{ $treatment->id == $data->treatment_id ? 'selected' : '' }}>
                                {{ $treatment->name }}
                            </option>
                        @endforeach
                    </x-select>
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
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
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
