<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Layanan Tambahan', 'url' => route('admin.addon.index')],
        ['name' => 'Ubah Layanan Tambahan', 'url' => ''],
    ]" title="Ubah Layanan Tambahan" />

    <div class="lg:w-full">
        <x-card-container>
            <form action="{{ route('admin.addon.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">
                    <x-input id="name" label="Nama Layanan Tambahan" name="name"
                        value="{{ old('name', $data->name) }}" required />
                    <x-input id="price" label="Harga" name="price" type="text"
                        value="Rp. {{ number_format(old('price', $data->price), 0, ',', '.') }}" required />
                    <x-input id="fee_percentage" label="Persentase Biaya" name="fee_percentage" type="number"
                        value="{{ old('fee_percentage', $data->fee_percentage) }}" required />
                </div>
                <div class="max-md:w-full md:w-1/2 lg:w-1/3 xl:w-1/3 pt-5">
                    <x-button type="submit">Simpan</x-button>
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

                var fee_percentageInput = document.getElementById('fee_percentage');
                fee_percentageInput.addEventListener('input', function(event) {
                    handleChange(this);
                });
            });
        </script>
        <script>
            function handleChange(input) {
                if (input.value < 0) input.value = 0;
                if (input.value > 100) input.value = 100;
            }
        </script>
    @endpush
</x-app-layout>
