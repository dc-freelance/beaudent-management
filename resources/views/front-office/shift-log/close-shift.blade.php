<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Tutup Sesi', 'url' => ''],
    ]" title="Tutup Sesi" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('front-office.shift-log.close-shift-update', $checking->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <x-input id="user" label="Pengguna Aktif" name="user"
                        value="{{ auth()->user()->name }} - ({{ auth()->user()->branch->code }} - {{ auth()->user()->branch->name }})"
                        readonly="readonly" />
                    <x-input id="total_cash_payment" label="Jumlah uang tunai yang diharapkan" type="text"
                        name="total_cash_payment" value="Rp. {{ number_format($totalCashPayment, 0, ',', '.') }}" readonly="readonly"
                        required="required" />
                    <x-input id="total_cash_received" label="Jumlah uang tunai sebenarnya" type="text"
                        name="total_cash_received" required="required" />
                </div>
                <div class="max-md:w-2/3 max-md:mx-auto md:w-1/4 lg:w-1/4 xl:1/4 pt-5">
                    <x-button type="submit">Tutup Sesi</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var totalCashRecievedInput = document.getElementById('total_cash_received');
                totalCashRecievedInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });

                var totalCashPaymentInput = document.getElementById('total_cash_payment');
                totalCashPaymentInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });
            });
        </script>
    @endpush
</x-app-layout>
