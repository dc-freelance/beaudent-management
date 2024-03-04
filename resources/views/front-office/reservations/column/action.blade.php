<div class="lg:flex gap-x-2">
    @if ($data->status === 'Confirm')
        @can('reschedule_reservation')
            <a href="{{ route('front-office.reservations.confirm.reschedule', $data->id) }}"
                class="btn bg-teal-500 text-white hover:bg-teal-700 focus:bg-teal-700">
                Jadwal ulang
            </a>
        @endcan
        @can('detail_reservation')
            <a href="{{ route('front-office.reservations.confirm.detail', $data->id) }}"
                class="btn btn-primary">
                Detail
            </a>
        @endcan
    @elseif ($data->status === 'Pending')
        @can('detail_reservation')
            <a href="{{ route('front-office.reservations.wait.detail', $data->id) }}"
                class="btn btn-primary">
                Detail
            </a>
        @endcan
    @else
        @can('detail_reservation')
            <a href="{{ route('front-office.reservations.cancel.detail', $data->id) }}"
                class="btn btn-primary">
                Detail
            </a>
        @endcan
    @endif

    @can('delete_reservation')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </label>
    @endcan
</div>
