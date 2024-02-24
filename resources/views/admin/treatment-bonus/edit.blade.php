<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Bonus Layanan', 'url' => route('admin.treatment-bonus.index')],
        ['name' => 'Ubah', 'url' => ''],
    ]" title="Ubah" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.treatment-bonus.update', $data->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <x-select id="treatment_id" label="Layanan" name="treatment_id" required>
                    <option value="" selected disabled>Pilih Layanan</option>
                    @foreach ($treatments as $treatment)
                        <option value="{{ $treatment->id }}"
                            {{ $treatment->id == $data->treatment_id ? 'selected' : '' }}>
                            {{ $treatment->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-select id="doctor_category_id" name="doctor_category_id" label="Kategori Dokter" required>
                    <option value="" selected disabled>Pilih Kategori Dokter</option>
                    @foreach ($doctorCategories as $doctorCategory)
                        <option value="{{ $doctorCategory->id }}"
                            {{ $doctorCategory->id == $data->doctor_category_id ? 'selected' : '' }}>
                            {{ $doctorCategory->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-select id="bonus_type" name="bonus_type" label="Tipe Bonus" required>
                    <option value="" selected disabled>Pilih Tipe Bonus</option>
                    <option value="percentage" {{ $data->bonus_type == 'percentage' ? 'selected' : '' }}>Persentase
                    </option>
                    <option value="nominal" {{ $data->bonus_type == 'nominal' ? 'selected' : '' }}>Nominal</option>
                </x-select>
                <x-input id="bonus_rate" name="bonus_rate" type="text" label="Bonus"
                    value="{{ $data->bonus_type == 'percentage'
                        ? number_format($data->bonus_rate, 1)
                        : // remove decimal after comma if it's 0, and remove .
                        number_format($data->bonus_rate, 0, ',', '') }}" />
                <div class="mt-6">
                    <x-button type="submit">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            function percentageInput() {
                $('#bonus_rate').on('input', function() {
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
            }

            function nominalInput() {
                $('#bonus_rate').on('input', function() {
                    var value = $(this).val();
                    value = value.replace(/\D/g, '');
                    value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                    $(this).val(value);
                });
            }

            $(function() {
                $('#bonus_rate').on('input', function() {
                    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                });

                let tipPercentageTag = '<p class="mt-2 text-gray-500">Gunakan . (titik) untuk desimal</p>';
                let tipNominalTag = '<p class="mt-2 text-gray-500">Hanya angka</p>';

                let bonus_type = '{{ $data->bonus_type }}';
                if (bonus_type == 'percentage') {
                    $('#bonus_rate').after(tipPercentageTag);
                    percentageInput();
                } else {
                    $('#bonus_rate').after(tipNominalTag);
                    nominalInput();
                }

                $('#bonus_type').on('change', function() {
                    $('#bonus_rate').val('');
                    $('#bonus_rate').off('input');
                    if ($(this).val() == 'percentage') {
                        $('#bonus_rate').next().remove();
                        $('#bonus_rate').after(tipPercentageTag);
                        percentageInput();
                    } else {
                        $('#bonus_rate').next().remove();
                        $('#bonus_rate').after(tipNominalTag);
                        nominalInput();
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
