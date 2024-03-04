<div class="lg:flex gap-x-2">
    @if ($data->status === 'Waiting Deposit')
        @can('reschedule_deposit')
            <a href="{{ route('front-office.reservations.confirm.reschedule', $data->id) }}"
                class="btn bg-teal-500 text-white hover:bg-teal-700 focus:bg-teal-700">
                Jadwal ulang
            </a>
        @endcan
    @endif
    @if ($data->status === 'Pending Deposit')
        @can('detail_deposit')
            <a href="{{ route('front-office.deposit.wait.detail', $data->id) }}"
                class="btn btn-primary">
                Detail
            </a>
        @endcan
    @endif
    @can('delete_deposit')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </label>
    @endcan
</div>
