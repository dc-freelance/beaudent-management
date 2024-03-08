@canany(['update_transaction', 'print_transaction'])
    <div class="lg:flex gap-x-2">
        @can('update_transaction')
            <a href="{{ route('front-office.transaction.detail-transaction', $data->id) }}"
                class="text-white bg-orange-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                Ubah
            </a>
        @endcan
        @can('print_transaction')
            <a href="{{ route('front-office.transaction.print-transaction', $data->id) }}"
                class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                Cetak
            </a>
        @endcan
    </div>
@endcanany
