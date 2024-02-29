<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Layanan Tambahan', 'url' => route('admin.addon.index')],
        ['name' => 'Tambah Layanan Tambahan', 'url' => ''],
    ]" title="Tambah Layanan Tambahan" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.addon.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <x-input id="name" label="Nama Layanan Tambahan" name="name" required />
                    <x-input id="price" label="Harga" name="price" type="text" placeholder="Rp." required />
                    <x-input id="fee_percentage" label="Persentase Biaya (%)" type="text" name="fee_percentage" required />
                </div>
                <div class="mt-6">
                    <x-button type="submit">Tambah Layanan Tambahan</x-button>
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