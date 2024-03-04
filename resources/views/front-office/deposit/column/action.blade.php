<div class="lg:flex gap-x-2">
    {{-- @if ($data->status === 'Waiting Deposit')
        @can('reschedule_deposit')
            <a href="{{ route('front-office.reservations.confirm.reschedule', $data->id) }}"
                class="text-white bg-blue-500 focus:ring-4 hover:bg-blue-600 transition duration-300 ease-in-out focus:outline-none focus:ring-blue-600 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                Jadwal ulang
            </a>
        @endcan
    @endif --}}
    @can('detail_deposit')
        <a href="{{ route('front-office.deposit.wait.detail', $data->id) }}"
            class="text-white bg-green-400 hover:bg-green-500 transition duration-300 ease-in-out focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
            Detail
        </a>
    @endcan
    @if ($data->status !== 'Waiting Deposit')
        @can('delete_deposit')
            <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
                class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-600 transition duration-300 ease-in-out font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer">
                Batal
            </label>
        @endcan
    @endif
</div>
