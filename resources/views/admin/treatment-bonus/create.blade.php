<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Bonus Layanan', 'url' => route('admin.treatment-bonus.index')],
        ['name' => 'Tambah', 'url' => ''],
    ]" title="Tambah" />

    <div class="lg:w-full">
        <x-card-container>
            <form action="{{ route('admin.treatment-bonus.store') }}" method="POST" class="">
                @csrf
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">
                    <x-select id="treatment_id" label="Layanan" name="treatment_id" required>
                        <option value="" selected disabled>Pilih Layanan</option>
                        @foreach ($treatments as $treatment)
                            <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
                        @endforeach
                    </x-select>
                    <x-select id="doctor_category_id" name="doctor_category_id" label="Kategori Dokter" required>
                        <option value="" selected disabled>Pilih Kategori Dokter</option>
                        @foreach ($doctorCategories as $doctorCategory)
                            <option value="{{ $doctorCategory->id }}">{{ $doctorCategory->name }}</option>
                        @endforeach
                    </x-select>
                    <x-select id="bonus_type" name="bonus_type" label="Tipe Bonus" required>
                        <option value="" selected disabled>Pilih Tipe Bonus</option>
                        <option value="percentage">Persentase</option>
                        <option value="nominal">Nominal</option>
                    </x-select>
                    <x-input id="bonus_rate" name="bonus_rate" type="text" label="Bonus" />
                </div>
                <div class="mt-5">
                    <x-button type="submit">Tambah Bonus Layanan</x-button>
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
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });
            }

            $(function() {
                $('#bonus_rate').on('input', function() {
                    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                });

                let tipPercentageTag = '<p class="mt-2 text-gray-500">Gunakan . (titik) untuk desimal</p>';
                let tipNominalTag = '<p class="mt-2 text-gray-500">Hanya angka</p>';

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
