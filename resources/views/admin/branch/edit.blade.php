<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Cabang', 'url' => route('admin.branch.index')],
        ['name' => 'Ubah Cabang', 'url' => ''],
    ]" title="Ubah Cabang" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.branch.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <x-input id="code" label="Kode Cabang" name="code" value="{{ $data->code }}"
                        readonly="readonly" required />
                    <x-input id="name" label="Nama Cabang" name="name" value="{{ $data->name }}" required />
                    <x-input id="phone_number" label="Nomor Telepon" name="phone_number" type="number"
                        value="{{ $data->phone_number }}" required />
                    <x-input id="address" label="Alamat" name="address" value="{{ $data->address }}" required />
                    <x-input id="deposit_minimum" label="Deposit Minimum" name="deposit_minimum" type="text"
                        placeholder="Rp." required
                        value="Rp. {{ number_format($data->deposit_minimum, 0, ',', '.') }}" />
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
