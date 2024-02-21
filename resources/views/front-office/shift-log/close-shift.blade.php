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
                    <x-input id="user" label="Pengguna Aktif" name="user" value="{{ auth()->user()->name }} - ({{ auth()->user()->branch->code }} - {{ auth()->user()->branch->name }})" readonly="readonly"/>
                    <x-input id="total_cash_payment" label="Jumlah uang tunai yang diharapkan" type="number" name="total_cash_payment" required="required"/>
                    <x-input id="total_cash_received" label="Jumlah uang tunai sebenarnya" type="number" name="total_cash_received" required="required"/>
                </div>
                <div class="mt-6">
                    <x-button type="submit">Tutup Sesi</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>