<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Layanan Tambahan', 'url' => route('admin.addon.index')],
        ['name' => 'Tambah Layanan Tambahan', 'url' => ''],
    ]" title="Tambah Layanan Tambahan" />

    <div class="lg:w-full">
        <x-card-container>
            <form action="{{ route('admin.addon.store') }}" method="POST">
                @csrf
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">
                    <x-input id="name" label="Nama Layanan Tambahan" name="name" required />
                    <x-input id="price" label="Harga" name="price" type="text" placeholder="Rp." required />
                    <x-input id="fee_percentage" label="Persentase Biaya (%)" type="number" name="fee_percentage"
                        required />
                </div>
                <div class="max-md:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 pt-5">
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
