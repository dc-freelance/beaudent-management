<div class="lg:flex gap-x-2">
    @can('print_shift_log')
        <a href="{{ route('front-office.shift-log.recap-shift-pdf', $data->id) }}"
            class="btn btn-light">
            <i class="fas fa-print fa-sm"></i>
            Cetak
        </a>
    @endcan
</div>
