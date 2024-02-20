<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Reservasi Terkonfirmasi', 'url' => route('front-office.reservations.confirm.index')],
        ['name' => 'Penjadwalan Ulang', 'url' => '#'],
    ]" title="Penjadwalan Ulang" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('front-office.reservations.confirm.reschedule.update', $data->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="space-y-6 mb-6">
                    <x-input id="request_date" label="Tanggal Reservasi" name="request_date" type="date" required
                    :value="$data->request_date" />
                    <x-input id="request_time" label="Waktu Reservasi" name="request_time" type="time" required 
                    :value="$data->request_time"/>
                    <x-input id="alasan" label="Alasan" name="alasan" required type="text" value="{{ $data->alasan }}" />
                </div>
                <x-button type="submit" class="mt-6">Jadwalkan Ulang</x-button>
            </form>
        </x-card-container>
    </div>

</x-app-layout>
