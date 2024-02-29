<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Layanan Tambahan', 'url' => route('admin.addon.index')],
        ['name' => 'Ubah Layanan Tambahan', 'url' => ''],
    ]" title="Ubah Layanan Tambahan" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.addon.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <x-input id="name" label="Nama Layanan Tambahan" name="name" value="{{ old('name', $data->name) }}" required />
                    <x-input id="price" label="Harga" name="price" type="text" value="Rp. {{ number_format(old('price', $data->price), 0, ',', '.') }}" required />
                    <x-input id="fee_percentage" label="Persentase Biaya" name="fee_percentage" type="text" value="{{ old('fee_percentage', $data->fee_percentage) }}" required />
                </div>
                <div class="mt-6">
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