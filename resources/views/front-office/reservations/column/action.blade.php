<div class="lg:flex gap-x-2">
    @if ($data->status === 'Confirm')
        @can('reschedule_reservation')
            <a href="{{ route('front-office.reservations.confirm.reschedule', $data->id) }}"
                class="text-white bg-orange-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                Jadwal ulang
            </a>
        @endcan
        @can('detail_reservation')
            <a href="{{ route('front-office.reservations.confirm.detail', $data->id) }}"
                class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                Detail
            </a>
        @endcan
    @elseif ($data->status === 'Pending')
        @can('detail_reservation')
            <a href="{{ route('front-office.reservations.wait.detail', $data->id) }}"
                class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                Detail
            </a>
        @endcan
    @else
        @can('detail_reservation')
            <a href="{{ route('front-office.reservations.cancel.detail', $data->id) }}"
                class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                Detail
            </a>
        @endcan
    @endif

    @can('delete_reservation')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer">
            Hapus
        </label>
    @endcan
</div>
