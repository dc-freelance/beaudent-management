<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Cabang', 'url' => route('admin.branch.index')],
        ['name' => 'Tambah Cabang', 'url' => ''],
    ]" title="Tambah Cabang" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.branch.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <x-input id="code" label="Kode Cabang" name="code" value="{{ $generate_code }}"
                        readonly="readonly" required />
                    <x-input id="name" label="Nama Cabang" name="name" required />
                    <x-input id="phone_number" label="Nomor Telepon" name="phone_number" type="number" required />
                    <x-input id="address" label="Alamat" name="address" required />
                    <x-input id="deposit_minimum" label="Deposit Minimum" name="deposit_minimum" type="text"
                        placeholder="Rp." required />
                </div>
                <div class="max-md:w-1/2 max-md:mx-auto md:w-1/3 lg:w-1/3 xl:w-1/3 pt-5">
                    <x-button type="submit">Tambah Cabang</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var depositInput = document.getElementById('deposit_minimum');
                depositInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });
            });
        </script>
    @endpush
</x-app-layout>
