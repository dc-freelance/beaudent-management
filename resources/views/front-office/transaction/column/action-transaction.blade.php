@canany(['update_transaction', 'print_transaction'])
    <div class="lg:flex gap-x-2">
        @can('update_transaction')
            <a href="{{ route('front-office.transaction.detail-transaction', $data->id) }}"
                class="btn btn-ediit">
                Ubah
            </a>
        @endcan
        @can('print_transaction')
            <a href="{{ route('front-office.transaction.print-transaction', $data->id) }}"
                class="btn btn-light">
                Cetak
            </a>
        @endcan
    </div>
@endcanany
