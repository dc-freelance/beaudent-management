<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Bonus Layanan', 'url' => route('admin.treatment-bonus.index')],
        ['name' => 'Tambah', 'url' => ''],
    ]" title="Tambah" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.treatment-bonus.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <p>Layanan</p>
                    <div class="mt-1">
                        <select id="treatment_id" name="treatment_id"
                            class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="" selected disabled>Pilih Layanan</option>
                            @foreach ($treatments as $treatment)
                                <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <p>Kategori Dokter</p>
                    <div class="mt-1">
                        <select id="doctor_category_id" name="doctor_category_id"
                            class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="" selected disabled>Pilih Kategori Dokter</option>
                            @foreach ($doctorCategories as $doctorCategory)
                                <option value="{{ $doctorCategory->id }}">{{ $doctorCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <p>Tipe Bonus</p>
                    <div class="mt-1">
                        <select id="bonus_type" name="bonus_type"
                            class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="" selected disabled>Pilih Tipe Bonus</option>
                            <option value="percentage">Persentase</option>
                            <option value="nominal">Nominal</option>
                        </select>
                    </div>
                </div>
                <x-input id="bonus_rate" name="bonus_rate" type="text" label="Bonus" />
                <div class="mt-6">
                    <x-button type="submit">Tambah Bonus Layanan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                $('#bonus_rate').on('input', function() {
                    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                });

                let tipPercentageTag = '<p class="mt-2 text-gray-500">Gunakan . (titik) untuk desimal</p>';
                let tipNominalTag = '<p class="mt-2 text-gray-500">Hanya angka</p>';

                $('#bonus_type').on('change', function() {
                    if ($(this).val() == 'percentage') {
                        $('#bonus_rate').next().remove();
                        $('#bonus_rate').after(tipPercentageTag);
                    } else {
                        $('#bonus_rate').next().remove();
                        $('#bonus_rate').after(tipNominalTag);
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
